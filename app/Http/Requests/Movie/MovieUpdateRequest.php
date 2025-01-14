<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|min:10',
            'image' => 'nullable|file|mimes:png,jpg,jpeg',
            'release_date' => 'nullable|date',
            'rating' => 'nullable|numeric',
            'type_id' => 'nullable|exists:types,id',
            'director_id' => 'nullable|exists:directors,id',
            'trailer' => 'nullable|string',
            'production_id' => 'nullable|exists:productions,id',
            'actors' => 'nullable',
            'actors.*' => 'nullable|exists:actors,id',
            'genres' => 'nullable',
            'genres.*' => 'nullable|exists:genres,id',
        ];
    }
}
