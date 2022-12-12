<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checklevel
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
        $roles = array_slice(func_get_args(), 2);
        foreach ($roles as $role) {
            $user = \Auth::user()->level;
            if ($user == $role) {
                return $next($request);
            }
            
        }
        //cuma yg dipanggil disini yang tampil, klo tidak akan tampil di landingpage
        return redirect('/');
        
    }
}
