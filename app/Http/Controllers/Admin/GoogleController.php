<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        //dd(Socialite::driver('google'));
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('home');

    }

    protected function _registerOrLoginUser($data)
    {

        //dd($data);
        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {
            $user = new User();
            $user->name = 'Google_user';
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->image = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
