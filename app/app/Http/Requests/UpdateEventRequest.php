<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Alleen de organisator mag updaten → check in controller nog extra op ID
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name'                        => 'sometimes|required|string|max:255',
            'description'                 => 'nullable|string',
            'deadline'                    => 'sometimes|required|date|after:now',
            'privacy'                     => 'sometimes|required|in:public,private',
            'password_protected'          => 'sometimes|required|boolean',
            'password'                    => 'required_if:password_protected,true|string|min:6',
            'anonymous_contributions'     => 'sometimes|required|boolean',
            'show_contribution_breakdown' => 'sometimes|required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('password_protected')) {
            $this->merge([
                'password_protected' => filter_var($this->password_protected, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
        if ($this->has('anonymous_contributions')) {
            $this->merge([
                'anonymous_contributions' => filter_var($this->anonymous_contributions, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
        if ($this->has('show_contribution_breakdown')) {
            $this->merge([
                'show_contribution_breakdown' => filter_var($this->show_contribution_breakdown, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
    }
}
