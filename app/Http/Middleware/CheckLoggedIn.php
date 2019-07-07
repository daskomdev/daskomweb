<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CheckLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      switch ($guard) {
        case 'asisten':
            if (!Auth::guard($guard)->check()) 
                return redirect()->route('login');
            break;
        case 'praktikan':
            if (!Auth::guard($guard)->check()) 
                return redirect()->route('login');
            break;
        case 'all':
            if (!Auth::guard('praktikan')->check() && !Auth::guard('asisten')->check()) 
                return redirect()->route('login');
            break;
      }
      return $next($request);
    }
}
