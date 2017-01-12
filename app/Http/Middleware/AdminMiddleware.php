<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if($request->session()->get('type_user') == 'admin' && $request->session()->has('id') && $request->session()->has('token') && $request->session()->get('deadline') != 0) {
             return $next($request);
        }
        return redirect('/');
    }
}
