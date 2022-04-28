<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;


class Localization
{
    /**
     *
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user() && auth()->user()->locale){
            $locale = auth()->user()->locale;
        }elseif(session('locale')){
            $locale = session('locale');
        }else{
            $locale = app()->getLocale();
        }

        App::setLocale($locale);

        return $next($request);
    }
}