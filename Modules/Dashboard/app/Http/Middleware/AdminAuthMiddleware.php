<?php

namespace Modules\Dashboard\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // تحقق من الجارد admin
        if (! Auth::guard('admin')->check()) {
            return redirect()->route('admin.login'); // أو مسار تسجيل الدخول
        }

        return $next($request);
    }
}
