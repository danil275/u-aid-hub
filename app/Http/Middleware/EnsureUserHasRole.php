<?php

namespace App\Http\Middleware;

use App\Enums\AppRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()->hasRole(AppRole::from($role))) {
            abort(403, 'Доступ запрещен');
        }

        return $next($request);
    }
}
