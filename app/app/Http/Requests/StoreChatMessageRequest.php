<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatMessageRequest extends FormRequest
{
    /**
     * Alleen ingelogde gebruikers mogen chatberichten versturen.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Valideer dat:
     * - “message” verplicht is, een string en max. 1000 tekens lang.
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:1000',
        ];
    }
}
