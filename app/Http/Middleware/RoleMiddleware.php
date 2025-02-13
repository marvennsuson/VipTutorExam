<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , string $role): Response
    {
        if(!Auth::check()){
            return to_route('login');
        }
        $Authrole = Auth::user()->role;

        switch($role){
            case 'admin':
                if($Authrole == 1){
                    return $next($request);
                }
                break;
                case 'user':
                    if($Authrole == 2){
                        return $next($request);
                    }
                    break;
        }

        switch($Authrole){
            case 1:
                return redirect()->route('admin.dashboard.index');
            case 2:
                return redirect()->route('user.dashboard.index');
        }
        return redirect()->route('login');
    }
}
