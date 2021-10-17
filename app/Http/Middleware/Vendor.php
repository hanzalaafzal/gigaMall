<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Vendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->permissions_id == 3 || Auth::check() && Auth::user()->permissions_id == 4 || Auth::check() && Auth::user()->permissions_id == 5) {
            return $next($request);
        }
        else{
            return redirect('/');
        }
    }
}
