<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Company
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
        if(auth()->user()){
            if(auth()->user()->type == 'company'){
                return $next($request);
            }else{
                return abort('403');
            }
        }else{
            return redirect()->route('company.login');
        }
        return $next($request);
    }
}
