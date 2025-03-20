<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class TmdbService
{
    protected $baseUrl;
    protected $apiKey;
    protected $imageBaseUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('services.tmdb.base_url', 'https://api.themoviedb.org/3');
        $this->apiKey = Config::get('services.tmdb.api_key');
        $this->imageBaseUrl = Config::get('services.tmdb.image_base_url', 'https://image.tmdb.org/t/p/');
    }

    public function getTopRatedMovies($page = 1)
    {
        $cacheKey = "top_rated_movies_page_$page";
        
        return Cache::remember($cacheKey, 3600, function () use ($page) {
            $response = Http::get("{$this->baseUrl}/movie/top_rated", [
                'api_key' => $this->apiKey,
                'page' => $page,
            ]);
            
            return $response->json();
        });
    }

    public function getMovieDetails($movieId)
    {
        $cacheKey = "movie_details_$movieId";
        
        return Cache::remember($cacheKey, 3600, function () use ($movieId) {
            $response = Http::get("{$this->baseUrl}/movie/$movieId", [
                'api_key' => $this->apiKey,
                'append_to_response' => 'credits,videos,images,recommendations'
            ]);
            
            return $response->json();
        });
    }

    public function searchMovies($query, $page = 1)
    {
        $cacheKey = "search_movies_" . md5($query) . "_page_$page";
        
        return Cache::remember($cacheKey, 3600, function () use ($query, $page) {
            $response = Http::get("{$this->baseUrl}/search/movie", [
                'api_key' => $this->apiKey,
                'query' => $query,
                'page' => $page,
            ]);
            
            return $response->json();
        });
    }

    public function getImageUrl($path, $size = 'w500')
    {
        if (empty($path)) {
            return null;
        }
        
        return $this->imageBaseUrl . $size . $path;
    }
}
