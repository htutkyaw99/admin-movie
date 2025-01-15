<?php

namespace App\Http\Controllers\Api\Movie;

use App\Api\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieApiController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $movies = Movie::with(['actors', 'genres'])->get();

        if ($movies->count() < 1) {
            return $this->error(404, 'No Movies List');
        }

        return $this->ok(200, 'Movies List', MovieResource::collection($movies));
    }

    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->error(404, 'Movie Not Found!');
        }

        return $this->ok(200, "Movie Name : $movie->name", new MovieResource($movie));
    }

    public function store(MovieStoreRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('movies', $request->image);
        }

        $movie = Movie::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagepath,
            'release_date' => $request->release_date,
            'rating' => $request->rating,
            'trailer' => $request->trailer,
            'admin_id' => $request->admin_id,
            'type_id' => $request->type_id,
            'director_id' => $request->director_id,
            'production_id' => $request->production_id
        ]);

        $movie->actors()->sync($request->actors);
        $movie->genres()->sync($request->genres);

        return $this->ok(201, 'Movie Created', new MovieResource($movie));
    }

    public function update(MovieUpdateRequest $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->error(404, 'Movie Not Found!');
        }

        $imagepath = null;

        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('movies', $request->image);
        }

        if ($imagepath) {
            $updateData['image'] = $imagepath;
        }

        $updateData = $request->validated();

        $movie->update($updateData);

        if ($request->genres) {
            $movie->genres()->sync($request->genres);
        }

        if ($request->actors) {
            $movie->actors()->sync($request->actors);
        }

        return $this->ok(200, 'Movie Edited!', new MovieResource($movie));
    }

    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return $this->error(404, 'Movie Not Found!');
        }

        $movie->delete();

        return $this->ok(200, 'Movie Deleted!');
    }

    public function trash()
    {
        $movies = Movie::onlyTrashed()->get();

        if ($movies->count() < 1) {
            return $this->error(404, 'No Itmes in trash');
        }

        return $this->ok(200, 'Movies List in trash', MovieResource::collection($movies));
    }

    public function delete($id)
    {
        $movie = Movie::withTrashed()->find($id);

        if (!$movie) {
            return $this->error(404, "Movie Not Found!");
        }

        $movie->actors()->detach();

        $movie->genres()->detach();

        $movie->forceDelete();

        return $this->ok(200, 'Movie Deleted Permanantly!');
    }

    public function restore(string $id)
    {
        $movie = Movie::withTrashed()->find($id);

        if (!$movie) {
            return $this->error(404, "Movie Not Found!");
        }

        $movie->restore();

        return $this->ok(200, 'Movie Restored!');
    }

    public function favourite(Request $request, $id)
    {
        $user = $request->user();

        if ($user->favmovies->contains('id', $id)) {

            $user->favmovies()->detach($id);

            return $this->ok(201, "Removed from favorites!");
        }

        $user->favmovies()->attach($id);

        return $this->ok(201, "Added to favorites!");
    }

    public function favourite_list(Request $request)
    {
        $user = $request->user();

        $favoriteMovies = $user->favmovies;

        if ($favoriteMovies->count() < 1) {

            return $this->error(404, "No Fav movies");
        }

        return $this->ok(200, 'Fav movies list',  MovieResource::collection($favoriteMovies));
    }
}
