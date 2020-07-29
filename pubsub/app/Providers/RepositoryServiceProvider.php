<?php

namespace App\Providers;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Eloquent\SubscriptionRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\SubscriptionRepositoryInterface;
use Faker\Provider\Base;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }
}
