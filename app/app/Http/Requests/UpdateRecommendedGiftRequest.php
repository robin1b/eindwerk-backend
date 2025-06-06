<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecommendedGiftRequest extends FormRequest
{
    /**
     * Alleen ingelogde gebruikers (bv. admins) mogen aanbevolen cadeaus bijwerken.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Valideer dat:
     * - “affiliate_url” indien aanwezig geldig is als URL en max. 255 tekens.
     */
    public function rules(): array
    {
        return [
            'affiliate_url' => 'sometimes|required|url|max:255',
        ];
    }
}
