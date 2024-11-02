<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admins')->guest()) {
            return redirect()->to(Url('/') . '/admin/login');
        }
        return $next($request);
    }
}
