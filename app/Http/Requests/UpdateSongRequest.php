<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSongRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('songs')->ignore($this->song->id)->where('album_id', $this->song->album_id)
            ],
            'duration' => 'required|integer|min:1',
            'track_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('songs')->ignore($this->song->id)->where('album_id', $this->song->album_id)
            ],
            'file_path' => 'nullable|string|max:255' // Validação do arquivo deve ser feita no upload
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título da música é obrigatório',
            'title.unique' => 'Já existe uma música com este título no álbum',
            'track_number.unique' => 'Já existe uma música com este número de faixa no álbum',
            'duration.min' => 'A duração deve ser maior que zero'
        ];
    }
}