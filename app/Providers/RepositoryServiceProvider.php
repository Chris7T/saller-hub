<?php

namespace App\Providers;

use App\Repositories\Client\ClientEloquentRepository;
use App\Repositories\Client\ClientInterfaceRepository;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\User\UserInterfaceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserInterfaceRepository::class, UserEloquentRepository::class);
        $this->app->bind(ClientInterfaceRepository::class, ClientEloquentRepository::class);
    }
}
