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
            'name' => 'required|string|max:255' . $this->id,
            'description' => 'required|string|min:10',
            'image' => 'nullable|file|mimes:png,jpg,jpeg',
            'release_date' => 'required|date',
            'rating' => 'required|numeric',
            'type_id' => 'required|exists:types,id',
            'director_id' => 'required|exists:directors,id',
            'trailer' => 'required|string',
            'production_id' => 'required|exists:productions,id',
            'actors' => 'required',
            'actors.*' => 'required|exists:actors,id',
            'genres' => 'required',
            'genres.*' => 'required|exists:genres,id',
        ];
    }
}
