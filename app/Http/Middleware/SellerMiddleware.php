<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && (int) Auth::user()->role == User::ROLE_SELLER) {
            return $next($request);
        }
        elseif (Auth::check() && (int) Auth::user()->role == User::ROLE_ADMIN) {
            return redirect('/admin');
        }
        elseif (Auth::check() && (int) Auth::user()->role == User::ROLE_SB) {
            return redirect('/sb');
        } else {
            abort(404);
        }
    }
}
