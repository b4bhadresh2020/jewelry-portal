<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Exceptions\UnauthorizedException;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $permissions = is_array($permissions)
            ? $permissions
            : explode('|', $permissions);
        foreach ($permissions as $permission) {
            if (Auth::user()->hasPermission($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions();
    }
}
