<?php

namespace App\Providers;

use App\Http\Services\Interfaces\ProductServiceInterface;
use App\Http\Services\ProductService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }

    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
