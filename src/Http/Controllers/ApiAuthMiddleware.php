<?php

namespace Ebuyer\Totem\Http\Controllers;

use Closure;
use Illuminate\Http\Request;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('local', 'testing')) {
            return $next($request);
        }

        $api_key = config('totem.api.key');

        if ($api_key) {
            abort_if($request->input('api_key') !== $api_key, 403);
        }

        return $next($request);
    }
}
