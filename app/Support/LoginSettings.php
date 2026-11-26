<?php

namespace App\Support;

/**
 * Sign-in options managed from the admin panel ("Giriş Ayarları"), stored in the site
 * settings file (storage/app/settings.json, not tracked by git) under the "login" key.
 */
class LoginSettings
{
    public const DEFAULTS = [
        'email_code_enabled' => true,
        'google_enabled' => false,
        'google_client_id' => '',
        'google_client_secret' => '',
    ];

    public static function all(): array
    {
        $stored = setting('login');

        return array_merge(self::DEFAULTS, is_array($stored) ? $stored : []);
    }

    public static function emailCodeEnabled(): bool
    {
        return (bool) self::all()['email_code_enabled'];
    }

    /** Google sign-in is offered only when switched on AND both credentials are set. */
    public static function googleEnabled(): bool
    {
        $s = self::all();

        return (bool) $s['google_enabled'] && filled($s['google_client_id']) && filled($s['google_client_secret']);
    }
}
