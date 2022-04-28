<?php

namespace App\Providers;

use App\Repository\Business\CalculateRepository;
use App\Repository\Business\CodeRepository;
use App\Repository\Business\PlanRepository;
use App\Repository\Contract\CalculateInterface;
use App\Repository\Contract\CodeInterface;
use App\Repository\Contract\PlanInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CodeInterface::class, CodeRepository::class);
        $this->app->bind(PlanInterface::class, PlanRepository::class);
        $this->app->bind(CalculateInterface::class, CalculateRepository::class);
    }
}
