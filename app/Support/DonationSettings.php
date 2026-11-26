<?php

namespace App\Support;

/**
 * Donation options managed from the admin panel ("Bağış Ayarları"), stored in the
 * site settings under the "donation" key, with safe defaults.
 */
class DonationSettings
{
    public const DEFAULTS = [
        'presets' => [50, 100, 250, 500],
        'min_amount' => 5,
        'max_amount' => 1000000,
        'quick_donate_enabled' => true,
        'dedication_enabled' => true,
        'zakat_option_enabled' => true,
        'show_name_option_enabled' => true,
        'transparency_enabled' => true,
    ];

    public static function all(): array
    {
        $stored = setting('donation');

        return array_merge(self::DEFAULTS, is_array($stored) ? $stored : []);
    }

    public static function get(string $key)
    {
        return self::all()[$key] ?? null;
    }

    /** Preset amounts (sorted, unique, >= minimum). */
    public static function presets(): array
    {
        $min = self::min();
        $presets = array_values(array_unique(array_filter(
            array_map('intval', (array) self::get('presets')),
            fn ($v) => $v >= $min
        )));
        sort($presets);

        return $presets ?: self::DEFAULTS['presets'];
    }

    public static function min(): float
    {
        return max(1, (float) self::get('min_amount'));
    }

    public static function max(): float
    {
        return max(self::min(), (float) self::get('max_amount'));
    }

    public static function enabled(string $feature): bool
    {
        return (bool) self::get($feature . '_enabled');
    }
}
