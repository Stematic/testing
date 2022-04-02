<?php

declare(strict_types=1);

namespace Stematic\Testing\Providers;

use Illuminate\Support\ServiceProvider;
use Phar;

use function dirname;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        config(['logging.channels.single.path' => Phar::running()
            ? dirname(Phar::running(false)) . '/testing.log'
            : storage_path('logs/testing.log'),
        ]);
    }
}
