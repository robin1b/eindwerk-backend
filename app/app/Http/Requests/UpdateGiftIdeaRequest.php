<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGiftIdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Enkel ingelogde gebruikers (controller checkt later of zij de creator zijn)
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|url',
        ];
    }
}
