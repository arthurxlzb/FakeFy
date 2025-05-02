<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Mude para true para permitir requisições autenticadas
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
            'title' => 'required|string|max:255',
            'singer_id' => 'required|exists:singers,id',
            'album_id' => 'required|exists:albums,id',
            'track_number' => 'required|integer|min:1',
            'song_file' => 'required|file|mimes:mp3,wav,aac|max:20480',
        ];
    }
}
