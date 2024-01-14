<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTemplate;
use Symfony\Component\HttpFoundation\Response;

class isDosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->user()->level_user, ['Super Admin', 'Admin', 'Dosen'])) {
            return $next($request);
        } else {
            return ResponseJsonTemplate::responseJson(403, 'error', 'Forbidden', null);
        }
    }
}
