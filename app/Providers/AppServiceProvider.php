<?php

namespace App\Providers;

use App\Services\HubspotService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Hubspot API Service
        $this->app->bind(HubspotService::class, static function () {
            return new HubspotService(config('services.hubspot.key'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
