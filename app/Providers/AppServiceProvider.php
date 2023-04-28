<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any applica tion services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('upercase', function ($attributes, $values) {
            return strtoupper($values) === $values;
        });

        Validator::replacer('upercase', function ($messages, $attributes, $rules, $parameters) {
            return $attributes . ' is string upercase';
        });
    }
}
