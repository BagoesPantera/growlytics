<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return abort(404);
            // return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        $roles = func_get_args();
        // remove $request and $next from args
        if (count($roles) > 2) {
            $roles = array_slice($roles, 2);
        } else {
            $roles = [];
        }

        if (!empty($roles) && ! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
