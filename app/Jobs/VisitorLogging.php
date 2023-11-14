<?php

namespace App\Jobs;

use App\Models\ShetabitVisit;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class VisitorLogging implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $incoming;

    /**
     * Create a new job instance.
     */
    public function __construct($incoming)
    {
        $this->incoming = $incoming;
    }


    public function handle(): void
    {
        $ip = $this->incoming['ip'];

        $location = \Location::get($ip) ?: null;

        $data = [
            'method' => $this->incoming['method'],
            'url' => $this->incoming['url'],
            'device' => $this->incoming['device'],
            'platform' => $this->incoming['platform'],
            'browser' => $this->incoming['browser'],
            'ip' => $ip,
            'visitor_id' => $this->incoming['visitor_id'],
            'country_name' => ($location && $location->countryName) ? $location->countryName : null,
            'city_name' => ($location && $location->cityName) ? $location->cityName : null,
            'province_name' => ($location && $location->regionName) ? $location->regionName : null,
            'country_code' => ($location && $location->countryCode) ? $location->countryCode : null,
            
            // 'latitude' => ($location && $location->latitude) ? $location->latitude : null,
            // 'longitude' => ($location && $location->longitude) ? $location->longitude : null,
        ];

        ShetabitVisit::create($data);
    }


}

