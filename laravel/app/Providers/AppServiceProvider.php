<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use App\Observers\ModelActivityObserver;
use Illuminate\Database\Eloquent\Model;
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
        //
        Order::observe(ModelActivityObserver::class);
        Cart::observe(ModelActivityObserver::class);
    }
}
