<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return redirect()->route('login');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get('https://pueblo-nest-production.up.railway.app/api/v1/auth/profile');

        if ($response->status() === 200) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
