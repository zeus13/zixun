<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PublicUtilServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('PublicUtilService', function () {
            return new \App\Services\PublicUtil();
        });
    }
}