<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorExtendServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('enstring', function ($attr, $value) {
            return preg_match('/^[-A-Za-z0-9_]+$/u', $value);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
