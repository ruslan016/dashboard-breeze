<?php

namespace App\Http\Middleware;

use Error;
use Closure;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use GeoIp2\Exception\AddressNotFoundException;
use Illuminate\Support\Facades\App;

class IsraelOnly
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
        $ip = $request->ip();
        $reader = new Reader(storage_path('app/geoip/GeoLite2-Country.mmdb'));

        try {
            $record = $reader->country($ip);

            if ($record->country->isoCode !== 'IL') {
                abort(403, 'Access denied from your location.');
            }
        } catch (AddressNotFoundException $e) {
            // If the IP address is not found in the database, default to 'Unknown' or in case '127.0.0.1'
            if(env('APP_ENV')!=='local' && $ip!=='127.0.0.1'){
                $countryCode = 'Unknown';
                //sent email to support
            }
        
    }

        return $next($request);
    }

}
