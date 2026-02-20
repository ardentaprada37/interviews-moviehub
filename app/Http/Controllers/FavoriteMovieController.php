<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMovie;
use Illuminate\Http\Request;

class FavoriteMovieController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $favorites = auth()->user()->favoriteMovies()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'imdb_id' => 'required|string',
            'title' => 'required|string',
            'year' => 'nullable|string',
            'poster' => 'nullable|string',
            'plot' => 'nullable|string',
        ]);

        $favorite = auth()->user()->favoriteMovies()->updateOrCreate(
            ['imdb_id' => $validated['imdb_id']],
            $validated
        );

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('messages.favorite_added'),
            ]);
        }

        return back()->with('success', __('messages.favorite_added'));
    }

    public function destroy($id)
    {
        $favorite = auth()->user()->favoriteMovies()
            ->where('imdb_id', $id)
            ->firstOrFail();
        
        $favorite->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('messages.favorite_removed'),
            ]);
        }

        return back()->with('success', __('messages.favorite_removed'));
    }
}
