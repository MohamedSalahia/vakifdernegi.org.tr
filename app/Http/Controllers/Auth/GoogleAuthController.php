<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Support\LoginSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * "Google ile giriş" using Google's OAuth 2.0 / OpenID Connect endpoints directly
 * (no extra package). Credentials come from the admin "Giriş Ayarları" page.
 * Only Google accounts with a verified e-mail are accepted.
 */
class GoogleAuthController extends Controller
{
    private const AUTH_URL = 'https://accounts.google.com/o/oauth2/v2/auth';
    private const TOKEN_URL = 'https://oauth2.googleapis.com/token';
    private const USERINFO_URL = 'https://openidconnect.googleapis.com/v1/userinfo';

    public function redirect(Request $request)
    {
        abort_unless(LoginSettings::googleEnabled(), 404);
        $state = Str::random(40);
        $request->session()->put('google_oauth_state', $state);

        return redirect()->away(self::AUTH_URL . '?' . http_build_query([
            'client_id' => LoginSettings::all()['google_client_id'],
            'redirect_uri' => route('auth.google.callback'),
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $state,
            'prompt' => 'select_account',
        ]));
    }

    public function callback(Request $request, AccountService $accounts)
    {
        abort_unless(LoginSettings::googleEnabled(), 404);

        $expected = $request->session()->pull('google_oauth_state');
        if (!$expected || !hash_equals($expected, (string) $request->query('state')) || !$request->query('code')) {
            return redirect()->route('login')->with('error', __('site.google_login_failed'));
        }

        try {
            $settings = LoginSettings::all();
            $token = Http::asForm()->timeout(15)->post(self::TOKEN_URL, [
                'code' => $request->query('code'),
                'client_id' => $settings['google_client_id'],
                'client_secret' => $settings['google_client_secret'],
                'redirect_uri' => route('auth.google.callback'),
                'grant_type' => 'authorization_code',
            ])->throw()->json();

            $profile = Http::withToken($token['access_token'] ?? '')->timeout(15)->get(self::USERINFO_URL)->throw()->json();
        } catch (\Throwable $e) {
            Log::warning('Google sign-in failed', ['error' => $e->getMessage()]);

            return redirect()->route('login')->with('error', __('site.google_login_failed'));
        }

        if (empty($profile['email']) || empty($profile['email_verified']) || empty($profile['sub'])) {
            return redirect()->route('login')->with('error', __('site.google_login_failed'));
        }

        $user = $accounts->findOrCreateVerified($profile['email'], $profile['name'] ?? null, 'google:' . $profile['sub']);
        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(AccountService::homeFor($user));
    }
}
