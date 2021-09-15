<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard("admin")->check()) {
                return redirect('/admin');
            }
            if (Auth::guard("keluarga")->check()) {
                return redirect("/keluarga");
            }
            if (Auth::guard("erte")->check()) {
                return redirect("/rt");
            }
            if (Auth::guard("erwe")->check()) {
                return redirect("/rw");
            }
        }

        return $next($request);
    }
}
