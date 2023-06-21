<?php

namespace YellowDigital\LaravelChatgptMockApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use YellowDigital\LaravelChatgptMockApi\Commands\LaravelChatgptMockApiCommand;

class LaravelChatgptMockApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-chatgpt-mock-api')
            ->hasConfigFile()
            ->hasMigration('create_chatgpt_mock_responses_table');
    }
}
