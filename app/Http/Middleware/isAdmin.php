<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_id = Auth::user()->id;
        if ($auth_id) {
            $user = User::where('id', $auth_id)->with('roles')->first();
            if ($user && !$user->hasRole(['admin' ,'employee'])) {
                return redirect()->route('welcome');
            }
        }
        return $next($request);
    }
}
