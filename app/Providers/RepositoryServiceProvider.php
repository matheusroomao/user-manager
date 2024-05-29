<?php

namespace App\Providers;

use App\Repository\Business\UserRepository;
use App\Repository\Contracts\UserInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
    }
}