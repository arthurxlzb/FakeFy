<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSingerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'genre' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'bio' => 'nullable|string',
            'label' => 'nullable|string|max:100',
        ];
    }
}