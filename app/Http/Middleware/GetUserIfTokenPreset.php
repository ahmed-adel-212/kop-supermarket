<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Client as PassportClient;

class GetUserIfTokenPreset
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
        if ($request->hasHeader('authorization')) {
            $bearertoken = $request->bearerToken();
            $token = $request->header('authorization');
            if (!empty($bearertoken)) {
                return app(Authenticate::class)->handle($request, function ($request) use ($next) {
                    return $next($request);
                }, 'api');
            }
            if (!empty($token)) {
                $client = PassportClient::where('secret', $token)->first();
                if (!empty($client)) {
                    return $next($request);
                }
            }
        }

        return $next($request);
    }
}
