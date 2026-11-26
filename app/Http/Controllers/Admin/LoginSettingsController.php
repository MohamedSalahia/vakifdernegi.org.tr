<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\LoginSettings;
use Illuminate\Http\Request;

/** Admin: "Giriş Ayarları" — passwordless e-mail code and Google sign-in. */
class LoginSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings');
    }

    public function edit()
    {
        $settings = LoginSettings::all();
        $redirectUri = route('auth.google.callback');

        return view('admin.settings.login', compact('settings', 'redirectUri'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'google_client_id' => 'nullable|string|max:255',
            'google_client_secret' => 'nullable|string|max:255',
        ]);
        $current = LoginSettings::all();

        if ($request->boolean('google_enabled') && (!filled($data['google_client_id']) || (!filled($data['google_client_secret']) && !filled($current['google_client_secret'])))) {
            return back()->withInput()->withErrors(['google_client_id' => __('site.ls_google_missing')]);
        }

        setting(['login' => [
            'email_code_enabled' => $request->boolean('email_code_enabled'),
            'google_enabled' => $request->boolean('google_enabled'),
            'google_client_id' => trim((string) $data['google_client_id']),
            // empty field = keep the stored secret (it is never shown back)
            'google_client_secret' => filled($data['google_client_secret']) ? trim($data['google_client_secret']) : $current['google_client_secret'],
        ]])->save();

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.settings.login');
    }
}
