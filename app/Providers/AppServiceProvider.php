<?php

namespace App\Providers;

use Dmp\Services\SearchServices\SearchInterface;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            SearchInterface::class,
            config('services.search.engines.' . config('services.search.default'))
        );
    }
}
