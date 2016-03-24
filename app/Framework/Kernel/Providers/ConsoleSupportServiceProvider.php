<?php

namespace Inspirer\Framework\Kernel\Providers;

use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as LaravelProvider;

class ConsoleSupportServiceProvider extends LaravelProvider
{
    protected $providers = [
        ArtisanServiceProvider::class,
        'Illuminate\Console\ScheduleServiceProvider',
        'Illuminate\Database\MigrationServiceProvider',
        'Illuminate\Database\SeedServiceProvider',
        'Illuminate\Foundation\Providers\ComposerServiceProvider',
        'Illuminate\Queue\ConsoleServiceProvider',
    ];
}
