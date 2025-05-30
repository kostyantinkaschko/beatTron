<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if(!$token || $token !== "Bearer " . env('API_ACCESS_TOKEN')){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
