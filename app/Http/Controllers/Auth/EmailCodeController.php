<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginCodeMail;
use App\Models\LoginCode;
use App\Services\AccountService;
use App\Support\LoginSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

/**
 * Passwordless sign-in: a 6-digit code is e-mailed, valid 10 minutes, single use,
 * max 5 attempts; only an HMAC of the code is stored. Unknown e-mails get an account
 * on successful verification. Responses never reveal whether an account exists.
 */
class EmailCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware(function ($request, $next) {
            abort_unless(LoginSettings::emailCodeEnabled(), 404);

            return $next($request);
        });
    }

    public function showRequest()
    {
        return view('auth.code_request');
    }

    public function send(Request $request)
    {
        $data = $request->validate(['email' => 'required|email|max:150']);
        $email = strtolower(trim($data['email']));

        // at most 3 codes per e-mail per 10 minutes
        $recent = LoginCode::where('email', $email)->where('created_at', '>=', now()->subMinutes(LoginCode::TTL_MINUTES))->count();
        if ($recent < 3) {
            LoginCode::where('email', $email)->whereNull('used_at')->update(['used_at' => now()]); // invalidate older codes
            $code = (string) random_int(100000, 999999);
            LoginCode::create([
                'email' => $email,
                'code_hash' => LoginCode::hash($email, $code),
                'expires_at' => now()->addMinutes(LoginCode::TTL_MINUTES),
                'ip' => $request->ip(),
            ]);
            try {
                Mail::to($email)->send(new LoginCodeMail($code, app()->getLocale()));
            } catch (\Throwable $e) {
                Log::warning('Login code e-mail failed', ['error' => $e->getMessage()]);
            }
        }

        $request->session()->put('login_code_email', $email);

        if ($request->expectsJson()) {
            return response()->json(['message' => __('site.login_code_sent'), 'email' => $email]);
        }

        return redirect()->route('login.code.verify')->with('success', __('site.login_code_sent'));
    }

    public function showVerify(Request $request)
    {
        $email = $request->session()->get('login_code_email');
        if (!$email) {
            return redirect()->route('login.code');
        }

        return view('auth.code_verify', compact('email'));
    }

    public function verify(Request $request, AccountService $accounts)
    {
        $email = $request->session()->get('login_code_email');
        if (!$email) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages(['code' => __('site.login_code_expired')]);
            }

            return redirect()->route('login.code');
        }
        $data = $request->validate(['code' => 'required|digits:6']);

        $login = LoginCode::where('email', $email)->whereNull('used_at')->where('expires_at', '>', now())->latest('id')->first();
        if (!$login || $login->attempts >= LoginCode::MAX_ATTEMPTS) {
            throw ValidationException::withMessages(['code' => __('site.login_code_expired')]);
        }
        if (!hash_equals($login->code_hash, LoginCode::hash($email, $data['code']))) {
            $login->increment('attempts');

            throw ValidationException::withMessages(['code' => __('site.login_code_wrong')]);
        }

        $login->update(['used_at' => now()]);
        $user = $accounts->findOrCreateVerified($email);
        Auth::login($user, true);
        $request->session()->forget('login_code_email');
        $request->session()->regenerate();

        $target = redirect()->intended(AccountService::homeFor($user))->getTargetUrl();
        if ($request->expectsJson()) {
            return response()->json(['redirect' => $target]);
        }

        return redirect()->to($target);
    }
}
