<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
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
        if(Auth::check() && (Auth::user()->isRole()==1 || Auth::user()->isRole()==2)){
            return $next($request);
        }
        return redirect('logout');
    }
}
