<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
        Password::defaults(function () {
           return Password::min(8)
               ->letters()
               ->mixedCase()
               ->numbers()
               ->symbols();
        });

        Http::macro('spikkl', function (string $postalCode, string $houseNumber) {
            return Http::withOptions(['verify'=>false])->get(env('spikkl_url').
                '?key='.env('spikkl_key').
                '&postal_code='.$postalCode.
                '&street_number='.$houseNumber
            );
        });
    }
}
