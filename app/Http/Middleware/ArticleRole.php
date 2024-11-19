<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ArticleRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = Auth::user();

        // Pisahkan roles dengan delimiter '|'
        $rolesArray = explode('|', $roles);

        // Cek apakah user memiliki role yang sesuai
        if (!$user || !in_array($user->role->name, $rolesArray)) {
            return redirect()->route('article.index')->with('error', 'Anda tidak memiliki akses!');
        }

        return $next($request);
    }
}
