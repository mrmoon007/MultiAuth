<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin
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
        if (!Auth::check())
        {
            return redirect()->route('admin.login');
        }
        $user = DB::table('users')->select('role_id')->where('id',Auth::user()->id)->first();
        if ($user->role_id == 2)
        {
            return $next($request);
        }

        return abort(403, 'Not authorized to access this page.');

    }
}
