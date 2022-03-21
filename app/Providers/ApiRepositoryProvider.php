<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiRepositoryProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contract\UserInterface','App\Repositories\Eloquent\UserRepository');
        $this->app->bind('App\Repositories\Contract\CategoriesInterface','App\Repositories\Eloquent\CategoriesRepository');
        $this->app->bind('App\Repositories\Contract\ProductInterface','App\Repositories\Eloquent\ProductRepository');
        $this->app->bind('App\Repositories\Contract\UserRoleInterface','App\Repositories\Eloquent\UserRoleRepository');
    }

    /**
     * provides the application services.
     *
     * @return [Array]
     */
    public function provides()
    {

    }
}
