<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // checked in controller (must be a participant)
    }

    public function rules(): array
    {
        return [
            'body' => ['required', 'string'],
        ];
    }
}