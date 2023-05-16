<?php

namespace App\Providers;
use App\Interfaces\Api\V1\ArticleRepositoryInterface;
use App\Repositories\Api\V1\ArticleRepository;
use App\Interfaces\Api\V1\UserRepositoryInterface;
use App\Repositories\Api\V1\UserRepository;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
