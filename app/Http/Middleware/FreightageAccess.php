<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FreightageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        if (Auth::user()->status == 'active') {
            return $next($request);
        }
        return redirect(route('freightage.dashboard'))->with('error', 'لطفا حساب کاربری خود را فعال سازی نمایید!');
    }
}