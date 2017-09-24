<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * 允许跨域访问资源 允许跨域访问 cookie
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->getMethod() == "OPTIONS") {
            return response(['OK'], 200)->withHeaders([
                'Access-Control-Allow-Origin' => $_SERVER['HTTP_ORIGIN'],
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Allow-Headers' => 'Authorization, Content-Type',
            ]);
        }
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            //允许跨域访问 cookie
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        return $next($request);
    }
}
