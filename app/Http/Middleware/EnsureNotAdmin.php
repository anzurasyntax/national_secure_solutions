<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps administrator accounts out of the student learning portal (they use /admin).
 */
class EnsureNotAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user !== null && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
