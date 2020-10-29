<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class notLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('tasks');
        }
        return $next($request);
    }
}
