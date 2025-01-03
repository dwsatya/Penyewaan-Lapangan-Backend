<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    protected $auth;

    // Constructor
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    // Middleware Handle
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard && $this->auth->guard($guard)->guest()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
