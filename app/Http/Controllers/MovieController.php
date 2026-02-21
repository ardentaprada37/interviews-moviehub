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
        
 
        if (!empty($search)) {
            $movies = $this->omdbService->searchMovies($search, $page);
            $isSearching = true;
        } else {
         
            $movies = $this->omdbService->getPopularMovies($page);
            $isSearching = false;
        }

      
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
