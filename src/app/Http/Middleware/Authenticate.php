<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected $user_login = 'user.login';
    protected $owner_login = 'owner.login';
    protected $admin_login = 'admin.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Route::is('owner.*')) {
                return route(self::$owner_login);
            } elseif (Route::is('admin.*')) {
                return route('admin.login');
            } else {
                return route(self::$user_login);
            }
        }
    }
}
