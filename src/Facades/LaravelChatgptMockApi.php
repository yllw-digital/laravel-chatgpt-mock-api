<?php

namespace YellowDigital\LaravelChatgptMockApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \YellowDigital\LaravelChatgptMockApi\LaravelChatgptMockApi
 */
class LaravelChatgptMockApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \YellowDigital\LaravelChatgptMockApi\LaravelChatgptMockApi::class;
    }
}
