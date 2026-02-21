<?php

namespace App\Http\Controllers;

use App\Services\OmdbService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $omdbService;

    public function __construct(OmdbService $omdbService)
    {
        $this->omdbService = $omdbService;
    }

    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        
        $movies = null;
        $isSearching = false;
        $errorMessage = null;
        
        // If user has entered a search term, search for it
        if (!empty($search)) {
            $movies = $this->omdbService->searchMovies($search, $page);
            $isSearching = true;
        } else {
            // Load popular movies by default
            $movies = $this->omdbService->getPopularMovies($page);
            $isSearching = false;
        }

        // Check for API errors
        if (isset($movies['Error'])) {
            $errorMessage = $movies['Error'];
        }

        if ($request->ajax()) {
            return response()->json($movies);
        }

        return view('movies.index', compact('movies', 'search', 'isSearching', 'errorMessage'));
    }

    public function show($id)
    {
        $movie = $this->omdbService->getMovieById($id);
        $isFavorite = auth()->user()->favoriteMovies()
            ->where('imdb_id', $id)
            ->exists();

        return view('movies.show', compact('movie', 'isFavorite'));
    }
}
