<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)

    {  
        // dd(auth()->user());
        
        if(Auth::guard($guard)->check()){
            
            if(Auth::user()->isAdmin()){
                // dd(55);
                  return $next($request); 
            }
         
        }
        // dd('aa');
        return redirect ('home');

        
    }
}
