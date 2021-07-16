<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class companyCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //dd($request->route()->parameters()['id']);
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->is_admin) {
                return $next($request);
            }
            if (Auth::user()->company_id!=$request->route()->parameters()['id']) {
                return redirect(route('company.showCompany', [Auth::user()->company_id]));
            }
        }
        return $next($request);
    }
}
