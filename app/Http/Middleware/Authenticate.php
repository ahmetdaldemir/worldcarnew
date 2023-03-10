<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request,$guards = "")
    {
        if (!$request->expectsJson()) {
            switch (current($guards)) {
                case 'admin-web':
                    return route('admin.login');
                default:
                    return '/';
            }
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request, $guards)
        );
    }
}
