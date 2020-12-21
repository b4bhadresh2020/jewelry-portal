<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddAgent
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
        $isMobileDevice = $this->isMobileDevice();
        $this->addParamToRequest($request, $isMobileDevice);
        return $next($request);
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return Request
     */
    protected function addParamToRequest(Request &$request, $isMobileDevice)
    {
        $input = $request->input();
        $input['isMobileDevice'] = $isMobileDevice;
        $request->replace($input);
        return $request;
    }

    public function isMobileDevice()
    {
        $aMobileUA = [
            '/iphone/i'     => 'iPhone',
            '/ipod/i'       => 'iPod',
            '/ipad/i'       => 'iPad',
            '/android/i'    => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i'      => 'Mobile'
        ];
        //Return true if Mobile User Agent is detected
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
                return $sMobileOS;
            }
        }
        //Otherwise return false..
        return false;
    }
}
