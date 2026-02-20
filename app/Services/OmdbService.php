<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.omdb.api_key');
        $this->baseUrl = config('services.omdb.url');
    }

    public function searchMovies($search, $page = 1)
    {
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            's' => $search,
            'page' => $page,
        ]);

        return $response->json();
    }

    public function getMovieById($imdbId)
    {
        $response = Http::get($this->baseUrl, [
            'apikey' => $this->apiKey,
            'i' => $imdbId,
            'plot' => 'full',
        ]);

        return $response->json();
    }
}
