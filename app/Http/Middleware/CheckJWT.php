<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class CheckJWT
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->cookie('token')) {
            $token = $request->cookie('token');
        } elseif ($request->bearerToken()) {
            $token = $request->bearerToken();
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $decoded = JWT::decode($token, env('JWT_SECRET'), array('HS256'));
        if ($decoded) {
            $user = User::where('_id', $decoded->_id)->first();
            if ($user) {
                $request->merge(['user' => $user]);
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }
}
