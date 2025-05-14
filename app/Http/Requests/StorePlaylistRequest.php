<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaylistRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'is_public' => 'nullable|boolean',
        'songs' => 'nullable|array',
        'songs.*' => 'exists:songs,id',
    ];
}


}
