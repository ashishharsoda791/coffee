<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        //
        View::composer('*', function ($view) {
            $userId = Auth::id();
            $cartCount = $userId ? Cart::where('user_id', $userId)->count() : 0;
            $view->with('cartCount', $cartCount);
        });

        View::composer('*', function ($view) {
            $userId = Auth::id();
            $orderCount = $userId ? Order::where('user_id', $userId)->count() : 0;
            $view->with('orderCount', $orderCount);
        });

        Paginator::useBootstrap();
    }
}
