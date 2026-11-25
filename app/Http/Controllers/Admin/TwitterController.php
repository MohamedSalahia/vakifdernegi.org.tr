<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    // Google login
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // Google callback
    public function handleTwitterCallback()
    {
        //dd(Socialite::driver('google'));
        $user = Socialite::driver('twitter')->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('home');

    }

    protected function _registerOrLoginUser($data)
    {

        //dd($data);
        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->image = $data->avatar;
            $user->save();
        }

        Auth::login($user);
    }
}
