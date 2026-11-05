<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class LocalWorkspace
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless(in_array($request->ip(), ['127.0.0.1', '::1']), 403, 'Panel hanya tersedia dari komputer lokal.');
        return $next($request);
    }
}
