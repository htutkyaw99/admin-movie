<?php

namespace App\Http\Controllers\Web\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Production;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with(['actors', 'genres'])->get();

        // dd($movies);

        return view('dashboard.movie.movie-list', [
            'movies' => $movies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $directors = Director::all();
        $productions = Production::all();
        $actors = Actor::all();
        $genres = Genre::all();

        return view(
            'dashboard.movie.movie-create',
            [
                'types' => $types,
                'directors' => $directors,
                'productions' => $productions,
                'actors' => $actors,
                'genres' => $genres
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request)
    {
        // dd($request->all());

        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('movies', $request->image);
        }

        $movie = Movie::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagepath,
            'release_date' => $request->release_date,
            'rating' => $request->rating,
            'admin_id' => 1,
            'type_id' => $request->type_id,
            'director_id' => $request->director_id,
            'production_id' => $request->production_id,
            'trailer' => $request->trailer,
        ]);

        $movie->actors()->attach($request->actors);
        $movie->genres()->attach($request->genres);

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return $movie;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $types = Type::all();
        $directors = Director::all();
        $productions = Production::all();
        $actors = Actor::all();
        $genres = Genre::all();

        return view(
            'dashboard.movie.movie-edit',
            [
                'types' => $types,
                'directors' => $directors,
                'productions' => $productions,
                'actors' => $actors,
                'genres' => $genres,
                'movie' => $movie
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        if ($request->hasFile('image')) {
            $movie->image = Storage::disk('public')->put('movies', $request->image);
        }

        $movie->name = $request->name;
        $movie->description = $request->description;
        $movie->release_date = $request->release_date;
        $movie->rating = $request->rating;
        $movie->type_id = $request->type_id;
        $movie->director_id = $request->director_id;
        $movie->production_id = $request->production_id;
        $movie->trailer = $request->trailer;
        $movie->update();
        $movie->actors()->sync($request->actors);
        $movie->genres()->sync($request->genres);

        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index');
    }


    public function trash()
    {
        $movies = Movie::onlyTrashed()->get();

        return view(
            'dashboard.movie.movie-trash-list',
            [
                'movies' => $movies
            ]
        );
    }

    public function delete($id)
    {
        $movie = Movie::withTrashed()->find($id);

        $movie->actors()->detach();

        $movie->genres()->detach();

        $movie->forceDelete();

        return redirect()->route('movies.trash');
    }

    public function restore($id)
    {
        $movie = Movie::withTrashed()->find($id);

        $movie->restore();

        return redirect()->route('movies.index');
    }
}
