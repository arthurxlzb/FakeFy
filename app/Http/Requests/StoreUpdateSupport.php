<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupport extends StoreUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:100000',
            ],
        ];

        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['subject'] = [
                'required', // 'nullable',
                'min:3',
                'max:255',
                // "unique:supports,subject,{$this->id},id",
                Rule::unique('supports')->ignore($this->support ?? $this->id),
            ];
        }

        return $rules;
    }
}
