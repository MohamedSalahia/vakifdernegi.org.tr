<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\CartTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, cartTrait;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function userLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            //'phone' => 'required',
        ]);

        //dd($request->phone);

        $user = User::where('phone', $request->phone)->first();
        //dd($user);
        // Check Condition Mobile No. Found or Not
        if ($user){
            if($request->phone != $user->phone) {

                //\Session::put('errors', 'Your mobile number not match in our system..!!');

                session()->flash('error_phone', __('site.errors'));
                return back();
            }
            \Auth::login($user);

            $count = self::cartCount();

            dd($count);
            //Session::put('count', $count);
            session(['count' => $count]);
            return redirect()->route('/');
        }else{
            session()->flash('error_phone', __('site.errors'));

            //return redirect()->route('/');

            return back();
        }


    }

    protected function validateUserLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
        ]);
    }

    protected function sendFailedUserLoginResponse(Request $request)
    {

        throw ValidationException::withMessages([
            $this->userphone() => [trans('auth.failed')],
        ]);
    }

    protected function attemptUserLogin(Request $request)
    {

        return $this->guard()->attempt(
            $this->credentialsphone($request), $request->boolean('remember')
        );



    }

    protected function credentialsphone(Request $request)
    {
        //dd($request->only($this->userphone()));
        return $request->only($this->userphone());

    }

    public function userphone()
    {
        //dd('asd');
        return 'phone';
    }

    public function logout(Request $request) {
        Auth::logout();
        session()->forget('count');
        return redirect('/login');
    }
}
