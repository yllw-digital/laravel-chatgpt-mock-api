<?php

namespace YellowDigital\LaravelChatgptMockApi\Commands;

use Illuminate\Console\Command;

class LaravelChatgptMockApiCommand extends Command
{
    public $signature = 'laravel-chatgpt-mock-api';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
