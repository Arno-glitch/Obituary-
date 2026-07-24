<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObituaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Server-side validation rules (backs up the client-side JS validation
     * in public/js/validate.js — never trust the client alone).
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:date_of_death'],
            'date_of_death' => ['required', 'date', 'after_or_equal:date_of_birth'],
            'content' => ['required', 'string', 'min:20'],
            'author' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_of_birth.before_or_equal' => 'Date of birth must be before the date of death.',
            'date_of_death.after_or_equal' => 'Date of death must be after the date of birth.',
        ];
    }
}
