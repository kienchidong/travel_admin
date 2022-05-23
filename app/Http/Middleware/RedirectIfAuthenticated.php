<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $uri = Session::get('redirectAfterLoginAdmin');


        switch ($guard){
            case 'admin':
                if(Auth::guard($guard)->check()){
                    if($uri != null){
                        return redirect($uri[0]);
                    } else {
                        return redirect()->route('admin.index');
                    }

                }
                break;
            default:
                if(Auth::guard($guard)->check()){
                    return redirect()->route('home');
                }
                break;
        }

        return $next($request);
        /*if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);*/
    }
}
