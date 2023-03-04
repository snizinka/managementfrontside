<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuthorized
{

    public function handle(Request $request, Closure $next): Response
    {
        if(is_null(session('token'))) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
