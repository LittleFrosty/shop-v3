<?php

namespace App\Features\User\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge(['id' => $this->route('id')]);
  }

  public function rules(): array{
    return [
      'id' => ['required', 'integer', 'exists:users,id'],
      'name' => ['sometimes', 'string', 'max:255'],
      'email' => [
        'sometimes',
        'email:rfc',
        'max:255',
        Rule::unique('users', 'email')->ignore($this->route('id')),
      ],
      'company' => ['sometimes', 'nullable', 'string', 'max:255'],
      'phone' => ['sometimes', 'nullable', 'string', 'max:256'],
      'password' => ['sometimes', 'string', 'min:8', 'max:255'],
      'country' => ['sometimes', 'string', 'max:255'],
      'city' => ['sometimes', 'string', 'max:255'],
      'address' => ['sometimes', 'string', 'max:255'],
      'status' => ['sometimes', 'integer', 'min:0'],
      'wholesale' => ['sometimes', 'boolean'],
      'wholesale_profile' => ['sometimes', 'integer', 'min:0'],
      'total_sum' => ['sometimes', 'numeric', 'decimal:0,2', 'between:0,999999.99'],
      'email_verified_at' => ['sometimes', 'nullable', 'date'],
    ];
  }
}
