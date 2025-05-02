<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSongRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $song = $this->route('song'); // Captura do model via route binding

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('songs')
                    ->ignore($song->id)
                    ->where('album_id', $song->album_id),
            ],
            'track_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('songs')
                    ->ignore($song->id)
                    ->where('album_id', $song->album_id),
            ],
            'song_file' => 'nullable|file|mimes:mp3,wav,aac|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título da música é obrigatório.',
            'title.unique' => 'Já existe uma música com este título neste álbum.',
            'track_number.unique' => 'Já existe uma música com este número de faixa neste álbum.',
            'song_file.mimes' => 'O arquivo deve ser MP3, WAV ou AAC.',
            'song_file.max' => 'O tamanho máximo do arquivo é 20MB.',
        ];
    }
}
