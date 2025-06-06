<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
{
    /**
     * Alleen ingelogde gebruikers mogen stemmen uitbrengen.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Valideer dat:
     * - “gift_idea_id” verplicht is en verwijst naar een bestaand cadeau in de database.
     */
    public function rules(): array
    {
        return [
            'gift_idea_id' => 'required|exists:gift_ideas,id',
        ];
    }
}
