<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ShoppingListRepositoryInterface;
use App\Repositories\EloquentShoppingListRepository;
use App\Contracts\ShoppingListItemRepositoryInterface;
use App\Repositories\EloquentShoppingListItemRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ShoppingListRepositoryInterface::class,
            EloquentShoppingListRepository::class
        );

        $this->app->bind(
            ShoppingListItemRepositoryInterface::class,
            EloquentShoppingListItemRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
