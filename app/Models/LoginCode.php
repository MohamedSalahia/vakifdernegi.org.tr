<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginCode extends Model
{
    public const TTL_MINUTES = 10;
    public const MAX_ATTEMPTS = 5;

    protected $guarded = ['id'];

    protected $casts = ['expires_at' => 'datetime', 'used_at' => 'datetime'];

    public static function hash(string $email, string $code): string
    {
        return hash_hmac('sha256', strtolower(trim($email)) . '|' . $code, config('app.key'));
    }
}
