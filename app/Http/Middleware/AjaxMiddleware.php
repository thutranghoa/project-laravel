<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Log;

class AjaxMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('Middleware triggered. Request type:', ['ajax' => $request->ajax()]);

        if (!$request->ajax()) {
            Log::warning('Forbidden request. Not an AJAX request.');
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);

    }
}


