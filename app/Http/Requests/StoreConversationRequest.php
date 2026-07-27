<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConversationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'participant_ids' => ['required', 'array', 'min:1'],
            'participant_ids.*' => ['exists:users,id'],
            'body' => ['required', 'string'],
        ];
    }
}