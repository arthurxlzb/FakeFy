<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlaylistRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'user_id' => 'required|exists:users,id',
            'songs' => 'nullable|array',
            'songs.*' => 'exists:songs,id',
        ];
    
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O título da playlist é obrigatório',
            'title.unique' => 'Você já tem uma playlist com este nome',
            'is_public.required' => 'A visibilidade da playlist é obrigatória'
        ];
    }
}
