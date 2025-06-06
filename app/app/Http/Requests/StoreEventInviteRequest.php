<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventInviteRequest extends FormRequest
{
    /**
     * Alleen de ingelogde organisator (controller checkt later) mag invites aanmaken.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Valideer dat:
     * - “email” verplicht is, geldig e-mailformaat én max. 255 tekens.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
        ];
    }
}
