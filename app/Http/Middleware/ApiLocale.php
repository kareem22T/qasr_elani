<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Carbon\Carbon;

class ApiLocale
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    public function handle($request, Closure $next)
    {
        $locale = $request->header('lang');
        if(!$locale || !in_array($locale, ['ar','en'])){
            $locale = 'ar';
            //$locale = $this->app->config->get('app.locale');
        }
        $this->app->setLocale($locale);
        Carbon::setLocale($locale);
        $request->headers->set('lang', $locale);
        return $next($request);
    }
}
