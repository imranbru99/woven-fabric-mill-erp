<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactor
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (! $user || ! $user->requiresTwoFactor() || $user->two_factor_confirmed_at) {
            return $next($request);
        }

        if ($request->routeIs('filament.*.pages.two-factor')) {
            return $next($request);
        }

        return redirect()->route('filament.admin.pages.two-factor');
    }
}
