<?php

namespace App\Http\Middleware;

use Closure;

class AdminAndOwnerMiddleware
{

    public function handle($request, Closure $next,$admin=null,$owner=null)
    {
        if ($admin and $owner){
            if (auth()->user()->role == $admin or auth()->user()->role == $owner)
                return $next($request);
            else{
                toast('Your Can\'t Access This Content','error');
                return redirect()->route('website');
            }
        }elseif($admin and ! $owner){
            if (auth()->user()->role == $admin)
                return $next($request);
            else{
                toast('Your Can\'t Access This Content','error');
                return redirect()->route('website');
            }
        }elseif ($owner and !$admin){
            if (auth()->user()->role == $owner)
                return $next($request);
            else{
                toast('Your Can\'t Access This Content','error');
                return redirect()->route('website');
            }
        }else{
            toast('Your Can\'t Access This Content','error');
            return redirect()->route('website');
        }
    }
}
