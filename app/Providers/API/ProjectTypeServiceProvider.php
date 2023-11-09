<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\ProjectTypeServices;
use App\Interfaces\API\ProjectTypeServiceInterface;

use App\Interfaces\API\ProjectTypeInterface;
use App\Repository\API\ProjectTypeRepository;

class ProjectTypeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(ProjectTypeInterface::Class, ProjectTypeRepository::Class);
        $this->app->bind(ProjectTypeServiceInterface::Class, ProjectTypeServices::Class);
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
