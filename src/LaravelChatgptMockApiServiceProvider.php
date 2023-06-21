<?php

namespace YellowDigital\LaravelChatgptMockApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use YellowDigital\LaravelChatgptMockApi\Commands\LaravelChatgptMockApiCommand;

class LaravelChatgptMockApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-chatgpt-mock-api')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-chatgpt-mock-api_table')
            ->hasCommand(LaravelChatgptMockApiCommand::class);
    }
}
