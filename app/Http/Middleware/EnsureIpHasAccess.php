<?php

namespace App\Http\Middleware;

use App\Http\Controllers\IpController;
use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class EnsureIpHasAccess
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
        if ($this->checkIpHasAccess($request)) {
            return $next($request);
        }else{
            return redirect('/');
        }
    }

    public function checkIpHasAccess($request)
    {
        $ip = ip2long($request->ip());
        // $high_ip = ip2long("2.176.0.0");
        // $low_ip = ip2long("2.191.255.255");
        $locatioInfo = Location::get('50.90.0.1');

        // if($locatioInfo->country == 'iran'){
        //     return true;
        // }else{
        //     return false;
        // }

        // if ($ip <= $high_ip && $low_ip <= $ip) {
        //     return true;
        // }

        
    }
}
