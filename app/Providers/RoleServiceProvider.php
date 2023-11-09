<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\RoleServices;
use App\Interfaces\RoleServiceInterface;

use App\Interfaces\RoleInterface;
use App\Repository\RoleRepository;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::Class, RoleRepository::Class);
        $this->app->bind(RoleServiceInterface::Class, RoleServices::Class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
