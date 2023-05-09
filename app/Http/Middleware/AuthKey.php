<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ClientKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = request()->bearerToken();
        $checkClientKey = ClientKey::where('key', $bearerToken)->exists();
        if (!$checkClientKey) {
            // abort(401);
            return response()->json('Unauthorized', 401);
        }
        return $next($request);
    }
}
