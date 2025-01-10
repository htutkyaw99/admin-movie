<?php

namespace App\Http\Controllers\Web\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\MovieRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.movie.movie-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.movie.movie-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        dd('Movie Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {

        dd('Movie Details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('dashboard.movie.movie-edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        dd('Movie Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        dd('Movie Deleted');
    }
}
