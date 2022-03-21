<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


/**
 * Class AclMiddleware
 *
 * @package App\Http\Middleware
 */
class PermissionMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 2) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}