<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Foundation\Application;
use Carbon\Carbon;

class AdminLocale
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    public function handle($request, Closure $next)
    {
        if (!Session::has('local')) {
            Session::put('local', 'ar');
            Carbon::setLocale(Session::get('local'));
        }
        $this->app->setlocale(Session::get('local'));
        Carbon::setLocale(Session::get('local'));
        return $next($request);
    }
}
