<?php

namespace App\Providers;

use App\Domain\Services\CommentService;
use App\Domain\Services\ImageService;
use App\Domain\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ImageService', function () {
            return new ImageService();
        });

        $this->app->singleton('UserService', function() {
           return new UserService();
        });

        $this->app->singleton('CommentService', function() {
           return new CommentService();
        });
    }
}
