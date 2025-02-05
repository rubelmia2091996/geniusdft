<?php

namespace App\Http\Middleware;

use Closure;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedByRequestDataException;

class TenantCheck
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (TenantCouldNotBeIdentifiedByRequestDataException $e) {
            return response()->json([
                'error' => 'Shop not found. Please check your domain.'
            ], 404);
        }
    }
}
