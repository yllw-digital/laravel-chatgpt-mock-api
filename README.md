# Laravel ChatGPT Mock API Generator
Generate smart API mocks in Laravel using ChatGPT prompts.

## Installation
```bash
composer require --dev yllw-digital/laravel-chatgpt-mock-api
```

You'll need to then publish the config file and migrations:
```bash
php artisan vendor:publish --provider="YellowDigital\LaravelChatgptMockApi\LaravelChatgptMockApiServiceProvider"
```

Run migrate to create the cache table:
```bash
php artisan migrate
```

Finally you'll need to add your OpenAI API key to your `.env` file:
```
OPENAI_API_KEY=sk-...
```

## Usage

In your `routes/api.php` file, add the following:
```php
use YellowDigital\LaravelChatgptMockApi\Facades\ChatGPTMockApi;

Route::get("/mock-response", function() {
    return ChatGPTMockApi::generate(
        prompt: "European countries and their national food",
        keys: [
            "id",
            "name",
            "food",
            "food_description",
        ],
        count: 3,
    );
});
```

This will generate a response like the following:
```json
[
    {
        "id": 1,
        "name": "Italy",
        "food": "Pizza",
        "food_description": "A delicious round dough topped with tomato sauce, cheese and a variety of toppings."
    },
    {
        "id": 2,
        "name": "France",
        "food": "Croissants",
        "food_description": "A flaky, buttery pastry that is commonly eaten for breakfast or as a snack."
    },
    {
        "id": 3,
        "name": "Spain",
        "food": "Paella",
        "food_description": "A rice dish that originated in Valencia and is typically made with saffron, chicken, and shellfish."
    }
]
```

## Caching
By default, the package will cache the generated responses in your DB so that you don't hit the OpenAI API limit. You can disable this by setting like so:
```php
ChatGPTMockApi::generate(
    prompt: "European countries and their national food",
    keys: [
        "id",
        "name",
        "food",
        "food_description",
    ],
    count: 3,
    cache: false,
);
```

## Changing ChatGPT model
By default, the package will use the `gpt-3.5-turbo` model. You can change this by setting like so:
```php
ChatGPTMockApi::generate(
    prompt: "European countries and their national food",
    keys: [
        "id",
        "name",
        "food",
        "food_description",
    ],
    count: 3,
    model: "gpt-3.5-turbo-0301",
);
```

## License
This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits
- [Yellow Digital](https://yllwdigital.com)