<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $prefix)
    {
        // 別ページからの遷移ならセッション殺す
        if (!preg_match('/' . $prefix . '/', url()->previous())) {
            $sessions = config('const.SESSION.' . strtoupper($prefix));
            foreach ($sessions as $sessionKey) {
                $request->session()->forget($sessionKey);
            }
        }
        return $next($request);
    }
}
