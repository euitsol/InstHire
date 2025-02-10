<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class InstituteAuthenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('institute.login');
    }

    protected function authenticate($request, array $guards)
    {
        if ($this->auth->guard('institute')->check()) {
            return $this->auth->shouldUse('institute');
        }

        $this->unauthenticated($request, ['institute']);
    }
}
