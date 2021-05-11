<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Permiso
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
        foreach (Auth::user()->roles as $roles){
            foreach ($roles->permisos as $permiso){
                if ($permiso->name != 'Acceso Full') {
                    return redirect('/');
                }else{
                    return $next($request);
                }
            }
        }
    }
}
