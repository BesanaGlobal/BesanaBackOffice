<?php

namespace App\Http\Middleware;

use App\Models\Affiliate;
use Closure;
use Illuminate\Http\Request;

class AfiliadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $user=Affiliate::where('idAffiliated',Auth()->user()->idAffiliated)->first();
      $activo=Auth()->user()->active;
            if ($activo) {
              
                return $next($request);
            }else{
                return redirect()->route('login');
            }

        
    }
}
