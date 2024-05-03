<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Il singleton permette di creare una sola istanza di Gateway che può accedere a tutta l'app
        $this->app->singleton(Gateway::class, function ($app) {

            return  new Gateway(
                [
                    'environment' => env('BRAINTREE_ENV'),
                    'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                    'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                    'privateKey' => env('BRAINTREE_PRIVATE_KEY')
                ]
            );
        });
    }
}