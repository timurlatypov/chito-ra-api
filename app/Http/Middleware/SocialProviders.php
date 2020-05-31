<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SocialProviders
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array(strtolower($request->provider), array_keys(config('social.providers')))) {
            return abort(404);
        }

        return $next($request);
    }
}
