<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if ($user->role->name != 'Administrator') {
            if ($role == 'client' && $user->role->name != 'Client') {
                abort(403);
            }
            if ($role == 'rmanager' && $user->role->name != 'Restaurant_manager') {
                abort(403);
            }
            if ($role == 'deliveryman' && $user->role->name != 'Deliveryman') {
                abort(403);
            }

            return $next($request);
        }

        return $next($request);
    }
}
