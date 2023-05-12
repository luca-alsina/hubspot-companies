<?php

namespace App\Providers;

use App\Contracts\HubspotServiceInterface;
use App\Services\Hubspot\HubspotService;
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
            return new HubspotService(\HubSpot\Factory::createWithAccessToken(config('services.hubspot.key')));
        });
        $this->app->bind(HubspotServiceInterface::class, HubspotService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
