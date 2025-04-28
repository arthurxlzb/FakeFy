<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // A autorização real deve ser tratada no controller/policy
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
                Rule::unique('albums')->ignore($this->album->id)
            ],
            'release_date' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título do álbum é obrigatório',
            'title.unique' => 'Já existe um álbum com este título',
            'release_date.required' => 'A data de lançamento é obrigatória',
            'cover_image.image' => 'O arquivo deve ser uma imagem válida',
            'cover_image.max' => 'A imagem não pode ter mais que 2MB'
        ];
    }
}