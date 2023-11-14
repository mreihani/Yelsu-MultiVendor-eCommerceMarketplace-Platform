<?php

namespace App\Http\Middleware;

use Closure;


use App\Jobs\VisitorLogging;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Response;
use Shetabit\Visitor\Contracts\UserAgentParser;
use Shetabit\Visitor\Exceptions\DriverNotFoundException;

class VisitorLogs {

    public function handle(Request $request, Closure $next): Response
    {
           
        if($request->getMethod() == "GET") {
            
            $incoming_array = [
                'method' => $request->getMethod(),
                'url' => $request->fullUrl(),
                'device' => Agent::device(),
                'platform' => Agent::platform(),
                'browser' => Agent::browser(),
                'ip' => $request->ip(),
                'visitor_id' => auth()->user() ? auth()->user()->id : null,
            ]; 

            dispatch(new VisitorLogging($incoming_array));
        }
        
        return $next($request);
    }
}
