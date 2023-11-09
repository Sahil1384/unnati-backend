<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\UserServices;
use App\Interfaces\API\UserServiceInterface;

use App\Interfaces\API\UserInterface;
use App\Repository\API\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(UserInterface::Class, UserRepository::Class);
        $this->app->bind(UserServiceInterface::Class, UserServices::Class);
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
