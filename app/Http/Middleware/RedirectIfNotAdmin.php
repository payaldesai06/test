<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!\Auth::guard($guard)->check() && !in_array(\Auth::user()->role_id,[1,3])) {
            return redirect('/login')->with('error','You have no access to login.');
        }

        return $next($request);
    }
}
