<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        // dd($_REQUEST);
        return $this->user()->hasRole('admin');
    }

   public function rules(): array
{
    $userId = $this->route('employee')?->id;

    return [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
        'password' => ['required', 'string', 'min:8'],
        'role' => ['required', 'in:employee,guest'],
        'company_id' => [
            'required',
            Rule::exists('companies', 'id')->where('owner_id', auth()->id()),
        ],
    ];
}
}