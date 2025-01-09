<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ChannelEngine\ChannelEngineMerchantApi;
use App\Contracts\MerchantApi;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        MerchantApi::class => ChannelEngineMerchantApi::class
    ];

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
    }
}
