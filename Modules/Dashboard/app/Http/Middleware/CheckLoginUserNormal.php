<?php

namespace Modules\Dashboard\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginUserNormal
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
//        dd("done");
        if (auth('web')->check()) {
            return abort(403);
        }
        return $next($request);
    }
}
