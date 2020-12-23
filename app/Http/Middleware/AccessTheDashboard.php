<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class AccessTheDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()){
            $user=auth()->user();
            if ($user->role == OWNER){
                // if the starting date + the plan period in months less than the current date (now =>allow )
                // else disable or prevent him from accessing the dashboard with message to renew the the plan
                if (!(Carbon::parse($user->plan_starting_date)->addMonths($user->plan->period)->greaterThanOrEqualTo(now()))){
                    Auth::logout();
                    toast('Your Plan Has Been Finished Renew It To Be Able To Access','error');
                    return redirect()->route('website');
                }
            }
        }

        return $next($request);
    }
}
