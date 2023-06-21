<?php

namespace YellowDigital\LaravelChatgptMockApi;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use YellowDigital\LaravelChatgptMockApi\Models\ChatgptMockResponse;

class LaravelChatgptMockApi
{
    public function generate(
        string $prompt,
        int $count = 1,
        array $keys,
        string $model = 'gpt-3.5-turbo',
        bool $cache = true
    ): JsonResponse {
        if($cache && $cachedResponse = $this->getCachedResponse($prompt, $count, $keys, $model)) {
            return $cachedResponse;
        }

        $openAiKey = config('chatgpt-mock-api.openai_key');

        if(!$openAiKey) {
            throw new \Exception('OpenAI key not set. Please set the OPENAI_API_KEY environment variable.');
        }
        
        $implodedKeys = implode(', ', $keys);

        $chatGptRequest = Http::withHeaders([
            'Authorization' => "Bearer {$openAiKey}",
            "Content-Type" => "application/json"
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => $model,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "You are a mock API JSON response generator. I will give you a prompt that the user entered that describes the data he wants, and then the keys that the data should have. Your response should only be the JSON, and must not contain any text before or after (such as: Below is your data). The prompt is: {$prompt}. The keys are: {$implodedKeys}. The number of entries that the JSON should have is: {$count}."
                ]
            ]
        ])->json();
        
        try {
            $response = json_decode($chatGptRequest['choices'][0]['message']['content']);
        } catch(\Exception $e) {
            throw new \Exception('OpenAI returned an invalid response. Please check your prompt and keys. Response: ' . json_encode($chatGptRequest));
        }

        $this->cacheResponse($prompt, $count, $keys, $model, $response);

        return response()->json($response);
    }

    private function getCachedResponse(
        string $prompt,
        int $count,
        array $keys,
        string $model
    ): ?JsonResponse {
        $hashSum = md5($prompt . $count . implode('', $keys) . $model);

        $existingChatGptMockResponse = ChatgptMockResponse::where('hashsum', $hashSum)->first();

        if($existingChatGptMockResponse) {
            return response()->json(json_decode($existingChatGptMockResponse->response));
        }

        return null;
    }

    private function cacheResponse(
        string $prompt,
        int $count,
        array $keys,
        string $model,
        array|object $response
    ): void {
        $hashSum = md5($prompt . $count . implode('', $keys) . $model);

        ChatGptMockResponse::where('hashsum', $hashSum)->delete();
        
        ChatgptMockResponse::create([
            'hashsum' => $hashSum,
            'prompt' => $prompt,
            'response' => json_encode($response)
        ]);
    }
}
