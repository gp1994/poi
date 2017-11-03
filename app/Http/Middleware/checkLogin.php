<?php

namespace App\Http\Middleware;

use Closure;

class checkLogin
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
       
        $response = $next($request);

        if (
                !$request->session()->has('usrn') &&  
                !$request->session()->has('pwd') &&
                !$request->session()->has('roles') ||
                $request->roles == 'user'
            ){

            return redirect('/');
        }

        return $response;
       
    }
}