<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // CompanyRepository
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);

        // ContactRepository
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);

    }

    public function boot(): void
    {
    }
}
