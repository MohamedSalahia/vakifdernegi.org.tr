<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanCreateAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (tenant()->canCreateAdmin()) {
            return $next($request);
        }

        abott(403, 'You are not allowed to create a admin.');

    }//end of handle

}// end of middleware
