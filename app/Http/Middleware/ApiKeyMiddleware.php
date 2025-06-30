<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Token yang valid (bisa disimpan di .env)
        $validApiKey = env('API_KEY', 'BGS8JfH5Xk3aPmLq9RwTdNsVyZbC67WQYo');

        // Ambil token dari header
        $apiKey = $request->header('X-API-KEY');

        // Validasi token
        if (!$apiKey || $apiKey !== $validApiKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}