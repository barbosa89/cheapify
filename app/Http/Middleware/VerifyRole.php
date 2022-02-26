<?php

namespace App\Http\Middleware;

use Closure;
use App\Constants\Roles;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Roles::exists($role)) {
            throw new InvalidArgumentException("Unknown role");
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->hasRole($role)) {
            return $next($request);

        }

        return abort(Response::HTTP_FORBIDDEN);
    }
}
