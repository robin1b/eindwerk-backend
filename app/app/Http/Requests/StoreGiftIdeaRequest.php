<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGiftIdeaRequest extends FormRequest
{
    /**
     * Alleen ingelogde gebruikers mogen cadeausuggesties toevoegen.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Valideer dat:
     * - “title” verplicht is, een string en max. 255 tekens.
     * - “description” optioneel is en een string.
     * - “image_url” optioneel is en een geldige URL.
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url'   => 'nullable|url',
        ];
    }
}
