<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class verificationAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->expectsJson()) {
            $response = [
                'success' => true,
                'data'    => auth()->user(),
                'message' => 'Must verify account',
            ];
            return response()->json($response, 200);
        }
        else{
            if(auth()->user()->email_verified_at == null)
            {
                return redirect()->route('verifyCode.page');
            }
        }
        return $next($request);
    }
}
