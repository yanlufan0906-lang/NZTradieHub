<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImproveDescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => [
                'required',
                'string',
                'max:'.config('ai.description.max_characters', 1500),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Enter a job description before using AI.',
            'description.string' => 'Enter a valid job description.',
            'description.max' => 'The job description must not exceed :max characters.',
        ];
    }
}
