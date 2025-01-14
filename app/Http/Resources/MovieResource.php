<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->when($request->routeIs('apiMovie.details'), $this->description),
            'image' => $this->when($request->routeIs('apiMovie.details'), $this->image),
            'release_date' => $this->release_date,
            'rating' => $this->rating,
            'trailer' => $this->when($request->routeIs('apiMovie.details'), $this->trailer),
            'actors' => ActorResource::collection($this->actors),
            'genres' => GenreResource::collection($this->genres),
            'admin' => $this->admin->name,
            'type' => $this->type->name,
            'director' => $this->when($request->routeIs('apiMovie.details'), $this->director->name),
            'production' => $this->when($request->routeIs('apiMovie.details'), $this->production->name),
        ];
    }
}
