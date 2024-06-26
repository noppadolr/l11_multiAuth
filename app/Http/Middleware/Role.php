<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $role = Auth::user()->role;
        if ($request->role !== $role) {

            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role == 'manager') {
                return redirect()->route('manager.dashboard');
            }elseif ($role == 'user') {
            return redirect()->route('dashboard');
            }


        return $next($request);
        }
    }
}
