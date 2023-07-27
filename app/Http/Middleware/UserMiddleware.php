<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isUser) {
            return $next($request);
        }
        abort(403, 'Anda Bukan User');
        // return back()->with('error', 'maaf, anda bukan user');
    }
}
