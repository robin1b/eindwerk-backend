<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecommendedGiftRequest extends FormRequest
{
    /**
     * Bepaal of de aanroepende gebruiker de request mag doen.
     * In dit geval willen we dat enkel ingelogde gebruikers (bv. admins)
     * aanbevolen cadeaus kunnen aanmaken.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Definieer hier de validatieregels voor het aanmaken van een RecommendedGift:
     * - gift_idea_id moet verplicht aanwezig zijn én bestaan in de gift_ideas-tabel.
     * - affiliate_url moet verplicht een geldige URL zijn.
     */
    public function rules(): array
    {
        return [
            'gift_idea_id' => 'required|exists:gift_ideas,id',
            'affiliate_url' => 'required|url|max:255',
        ];
    }
}
