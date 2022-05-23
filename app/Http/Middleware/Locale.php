<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class Locale
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
        if (Session::has('language')) {
            App::setLocale(Session::get('language'));
        } else {
            App::setLocale('vi');
        }
        /*if($language=$request->session()->get('language')){
            \App::setLocale($language);
        }*/
        return $next($request);
    }
}
