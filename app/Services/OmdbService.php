<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OmdbService
{
    protected $apiKey;
    protected $baseUrl;
    protected $timeout = 5; // 5 seconds timeout

    public function __construct()
    {
        $this->apiKey = config('services.omdb.api_key');
        $this->baseUrl = config('services.omdb.url');
    }

    public function searchMovies($search, $page = 1)
    {
        // Create cache key
        $cacheKey = "omdb_search_{$search}_{$page}";
        
        // Try to get from cache (cache for 1 hour)
        return Cache::remember($cacheKey, 3600, function () use ($search, $page) {
            try {
                $response = Http::timeout($this->timeout)->get($this->baseUrl, [
                    'apikey' => $this->apiKey,
                    's' => $search,
                    'page' => $page,
                ]);

                return $response->json();
            } catch (\Exception $e) {
                Log::error('OMDB API Error: ' . $e->getMessage());
                return ['Response' => 'False', 'Error' => 'Unable to connect to movie database'];
            }
        });
    }

    public function getMovieById($imdbId)
    {
        $cacheKey = "omdb_movie_{$imdbId}";
        
        return Cache::remember($cacheKey, 3600, function () use ($imdbId) {
            try {
                $response = Http::timeout($this->timeout)->get($this->baseUrl, [
                    'apikey' => $this->apiKey,
                    'i' => $imdbId,
                    'plot' => 'full',
                ]);

                return $response->json();
            } catch (\Exception $e) {
                Log::error('OMDB API Error: ' . $e->getMessage());
                return ['Response' => 'False', 'Error' => 'Unable to connect to movie database'];
            }
        });
    }

    public function getPopularMovies($page = 1)
    {
        // Use a simpler, more reliable search term that's likely cached
        // Use "movie" as default search which returns many results
        return $this->searchMovies('movie', $page);
    }
}
