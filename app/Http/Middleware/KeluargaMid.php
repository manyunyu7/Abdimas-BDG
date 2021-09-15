<?php

namespace App\Http\Middleware;

use App\Models\Keluarga;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluargaMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('keluarga')->check()){
            $keluarga = Keluarga::findOrFail(Auth::guard('keluarga')->id());
        }else if(Auth::guard('erte')->check()){
            
        }else if(Auth::guard('admin')->check()){

        }else if(Auth::guard('erwe')->check()){

        }
        else{
            abort('403');
        }

        return $next($request);
    }
}
