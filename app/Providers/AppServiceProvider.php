<?php

namespace App\Providers;

use App\Repository\ActivityRepository;
use App\Repository\ActivityRepositoryInterface;
use App\Repository\CompanyRepository;
use App\Repository\CompanyRepositoryInterface;
use App\Services\CompanyService;
use App\Services\CompanyServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
