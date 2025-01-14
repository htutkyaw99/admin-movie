<?php

namespace App\Http\Controllers\Api\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieApiController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['actors', 'genres'])->get();

        if ($movies->count() < 1) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'No Movies List',
            ], 404);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => 'Movie Lists',
            'count' => $movies->count(),
            'data' => MovieResource::collection($movies)
            // 'data' => $movies
        ], 200);
    }

    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Movie Not Found',
            ], 404);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie name : $movie->name",
            'data' => new MovieResource($movie)
        ], 200);
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

        return response()->json([
            'statusCode' => 201,
            'message' => "Movie Created!",
            'data' => new MovieResource($movie)
        ], 201);
    }

    public function update(MovieUpdateRequest $request, string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Movie Not Found!',
            ], 404);
        }

        $imagepath = null;

        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('movies', $request->image);
        }

        $updateData = $request->validated();

        if ($imagepath) {
            $updateData['image'] = $imagepath;
        }

        $movie->update($updateData);

        if ($request->genres) {
            $movie->genres()->sync($request->genres);
        }

        if ($request->actors) {
            $movie->actors()->sync($request->actors);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie Edited!",
            'data' => new MovieResource($movie),
        ], 200);
    }

    public function destroy(string $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Movie Not Found!',
            ], 404);
        }

        $movie->delete();

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie Deleted!",
        ], 200);
    }

    public function trash()
    {
        $movies = Movie::onlyTrashed()->get();

        if ($movies->count() < 1) {
            return response()->json([
                'statusCode' => 404,
                'message' => "No items in trash!",
            ], 404);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie List in Trash!",
            'data' => MovieResource::collection($movies)
        ], 200);
    }

    public function delete($id)
    {
        $movie = Movie::withTrashed()->find($id);

        if (!$movie) {
            return response()->json([
                'statusCode' => 404,
                'message' => "Not Found!",
            ], 404);
        }

        $movie->actors()->detach();

        $movie->genres()->detach();

        $movie->forceDelete();

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie deleted permantly!",
        ], 200);
    }

    public function restore(string $id)
    {
        $movie = Movie::withTrashed()->find($id);

        if (!$movie) {
            return response()->json([
                'statusCode' => 404,
                'message' => "Not Found!",
            ], 404);
        }

        $movie->restore();

        return response()->json([
            'statusCode' => 200,
            'message' => "Movie restored!!",
        ], 200);
    }
}
