<?php

namespace App\Providers\API;

use Illuminate\Support\ServiceProvider;

use App\Services\API\ProfileServices;
use App\Interfaces\API\ProfileServiceInterface;

use App\Interfaces\API\ProfileInterface;
use App\Repository\API\ProfileRepository;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(ProfileInterface::Class, ProfileRepository::Class);
        $this->app->bind(ProfileServiceInterface::Class, ProfileServices::Class);
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
