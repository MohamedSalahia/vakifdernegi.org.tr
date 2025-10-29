<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanCreateBranch
{
    public function handle(Request $request, Closure $next): Response
    {
        if (tenant()->canCreateBranch()) {
            return $next($request);
        }

        abort(403, 'You are not allowed to create a branch.');

    }//end of handle

}// end of middleware
