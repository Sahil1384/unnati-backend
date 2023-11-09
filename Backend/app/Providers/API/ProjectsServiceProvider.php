<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\ProjectsServices;
use App\Interfaces\API\ProjectsServiceInterface;

use App\Interfaces\API\ProjectsInterface;
use App\Repository\API\ProjectsRepository;

class ProjectsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(ProjectsInterface::Class, ProjectsRepository::Class);
        $this->app->bind(ProjectsServiceInterface::Class, ProjectsServices::Class);
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
