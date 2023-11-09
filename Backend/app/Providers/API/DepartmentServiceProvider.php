<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\DepartmentServices;
use App\Interfaces\API\DepartmentServiceInterface;

use App\Interfaces\API\DepartmentInterface;
use App\Repository\API\DepartmentRepository;

class DepartmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(DepartmentInterface::Class, DepartmentRepository::Class);
        $this->app->bind(DepartmentServiceInterface::Class, DepartmentServices::Class);
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
