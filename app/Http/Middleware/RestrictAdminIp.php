<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminIp
{
    public function handle(Request $request, Closure $next): Response
    {
        $list = array_values(array_filter(array_map('trim', explode(',', (string) config('mill.admin_ip_allowlist')))));
        if ($list !== [] && ! in_array($request->ip(), $list, true)) {
            abort(403, 'This terminal is not on the mill admin network.');
        }

        return $next($request);
    }
}
