<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\View;

use App\Http\Controllers\ModelController;

use App\Http\Controllers\UserController;

use App\Services\PaymentInterface;

use App\Services\Payment;

use App\Services\Paypal;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any applica tion services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ModelController::class)->needs(PaymentInterface::class)->give(Payment::class);

        $this->app->when(UserController::class)->needs(PaymentInterface::class)->give(Paypal::class);
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

        $title = '';

        try {

            if (!cache()->has('banners_redis')) {
                $title  =  view('components.title', ['title' => 'cache lai lan nua'])->render();
                cache()->put('banners_reids', $title);
            } else {
                $title = cache()->get('banners_redis');
            }
        } catch (Exception $ex) {
        }

        View::share('title', $title);
    }
}
