<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $userRole = strtolower($user->role->name ?? '');

        $allowedRoles = array_map(
            fn ($role) => strtolower(trim($role)),
            explode(',', $roles)
        );

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
