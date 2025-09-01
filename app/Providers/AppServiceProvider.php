<?php

namespace App\Providers;

use App\Repositories\Blog\BlogInterface;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\ProductViewed\RecentlyViewedRepository;
use App\Repositories\ProductViewed\RecentlyViewedRepositoryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Services\Blog\BlogService;
use App\Services\GeoLocationService;
use App\Services\ProductReviewed\RecentlyViewedService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RecentlyViewedRepositoryInterface::class, RecentlyViewedRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);


        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserInterface::class),
                $app->make(GeoLocationService::class)
            );
        });

        $this->app->bind(RecentlyViewedService::class, function ($app) {
            return new RecentlyViewedService($app->make(RecentlyViewedRepositoryInterface::class));
        });
        $this->app->bind(BlogService::class, function ($app) {
            return new BlogService($app->make(BlogInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
