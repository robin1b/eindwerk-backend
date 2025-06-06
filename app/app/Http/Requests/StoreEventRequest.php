<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name'                        => 'required|string|max:255',
            'description'                 => 'nullable|string',
            'deadline'                    => 'required|date|after:now',
            'privacy'                     => 'required|in:public,private',
            'password_protected'          => 'required|boolean',
            // “password” alleen verplicht indien password_protected op true staat
            'password'                    => 'required_if:password_protected,true|string|min:6',
            'anonymous_contributions'     => 'required|boolean',
            'show_contribution_breakdown' => 'required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Let op: booleans vanuit JSON/JavaScript komen soms als strings “true”/“false”
        // We casten ze hier expliciet naar echte booleans
        $this->merge([
            'password_protected'          => filter_var($this->password_protected, FILTER_VALIDATE_BOOLEAN),
            'anonymous_contributions'     => filter_var($this->anonymous_contributions, FILTER_VALIDATE_BOOLEAN),
            'show_contribution_breakdown' => filter_var($this->show_contribution_breakdown, FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
