<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\ProductSendEmail;
use App\Listeners\SendNewProductEmail;
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
      
        Event::listen([
            ProductSendEmail::class,
            SendNewProductEmail::class
        ]);
    }
}
