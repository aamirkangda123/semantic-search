<?php

namespace App\Services;
use OpenAI;

class VectorService
{
	protected $client;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
         $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    }

    public function getEmbedding(string $text): array
    {
        $response = $this->client->embeddings()->create([
            'model' => 'text-embedding-ada-002',
            'input' => $text,
        ]);

        return $response['data'][0]['embedding'];
    }

    public function cosineSimilarity(array $a, array $b): float
    {
        $dot = array_sum(array_map(fn($x, $y) => $x * $y, $a, $b));
        $magA = sqrt(array_sum(array_map(fn($x) => $x * $x, $a)));
        $magB = sqrt(array_sum(array_map(fn($y) => $y * $y, $b)));

        return $magA * $magB ? $dot / ($magA * $magB) : 0;
    }
}

