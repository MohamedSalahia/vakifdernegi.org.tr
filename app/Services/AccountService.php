<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/** Finds or creates the donor account behind a verified e-mail address (e-mail code / Google sign-in). */
class AccountService
{
    public function findOrCreateVerified(string $email, ?string $name = null, ?string $providerId = null): User
    {
        $email = strtolower(trim($email));
        $user = User::query()->whereRaw('LOWER(email) = ?', [$email])->first();

        if (!$user) {
            $user = User::create([
                'name' => $name ?: Str::title(str_replace(['.', '_', '-'], ' ', Str::before($email, '@'))),
                'email' => $email,
                'password' => Hash::make(Str::random(40)), // unusable random password; sign in with code/Google
                'provider_id' => $providerId,
                'email_verified_at' => now(),
            ]);
            $user->attachRole('user');

            return $user;
        }

        $changes = [];
        if (!$user->email_verified_at) {
            $changes['email_verified_at'] = now();
        }
        if ($providerId && !$user->provider_id) {
            $changes['provider_id'] = $providerId;
        }
        if ($changes) {
            $user->forceFill($changes)->save();
        }

        return $user;
    }

    /** Where to send a user after sign-in: admins to the panel, donors to their account. */
    public static function homeFor(User $user): string
    {
        return $user->hasRole(['admin', 'super_admin']) ? route('admin.home') : route('account');
    }
}
