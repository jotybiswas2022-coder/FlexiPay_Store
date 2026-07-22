<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // If specific role is required
        if ($role === 'super_admin') {
            if (!$user->isSuperAdmin()) {
                abort(403, 'Unauthorized. Super Admin access required.');
            }
        } elseif ($role === 'admin') {
            if (!$user->isAdmin()) {
                abort(403, 'Unauthorized. Admin access required.');
            }
        } else {
            // General admin check
            if (!$user->isAdmin()) {
                abort(403, 'Unauthorized. Admin access required.');
            }
        }

        return $next($request);
    }
}
