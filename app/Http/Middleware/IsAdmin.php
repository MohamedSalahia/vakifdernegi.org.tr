<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*if (Auth::user()->hasRole('super_admin')) {
            return $next($request);
        }*/

        //return redirect('home')->with('error','You have not admin access');


        /*if(!Auth::check()){
            return redirect()->route('login');
        }*/

        if(Auth::user()->hasRole('super_admin') == true){
            return $next($request);
        }

        return redirect()->back()->with('unauthorised', 'You are 
                  unauthorised to access this page');
    }
}
