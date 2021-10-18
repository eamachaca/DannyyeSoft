<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (count($guards) == 1 && $guards[0] == 'api' && !$this->auth->guard('api')->check()) {
            return response()->api(null, 403, config('api.codes.unauthorized'), config('api.messages.unauthorized'));
        } else
            $this->authenticate($request, $guards);

        return $next($request);
    }
}
