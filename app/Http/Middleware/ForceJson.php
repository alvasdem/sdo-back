<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class ForceJson 
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        //$request->headers->set('Accept', 'application/json');

        $data = $next($request);

        

        return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }
}