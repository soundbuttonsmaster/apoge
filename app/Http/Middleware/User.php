<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Session::has('user')) {
            $previous_url = Session::get('privouseUrl');
            if($previous_url){
                $request->session()->forget('privouseUrl');
                return redirect($previous_url);
            }
            return $next($request);
        }
        return redirect('/');

    }
}
