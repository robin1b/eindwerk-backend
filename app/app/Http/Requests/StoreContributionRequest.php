<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContributionRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Enkel ingelogde gebruikers mogen bijdragen plaatsen
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'amount'    => 'required|numeric|min:0.01',
            'anonymous' => 'required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Cast “anonymous” naar boolean als er een string binnenkomt
        if ($this->has('anonymous')) {
            $this->merge([
                'anonymous' => filter_var($this->anonymous, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
