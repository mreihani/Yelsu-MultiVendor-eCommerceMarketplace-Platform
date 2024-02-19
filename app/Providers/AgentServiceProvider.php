<?php

namespace App\Providers;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $agent = new Agent();

        View::share('agent', $agent);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
