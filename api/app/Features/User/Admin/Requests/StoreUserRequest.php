<?php

namespace App\Features\User\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email:rfc', 'max:255', Rule::unique('users', 'email')],
      'company' => ['nullable', 'string', 'max:255'],
      'phone' => ['nullable', 'string', 'max:256'],
      'password' => ['required', 'string', 'min:8', 'max:255'],
      'country' => ['required', 'string', 'max:255'],
      'city' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'status' => ['required', 'integer', 'min:0'],
      'wholesale' => ['required', 'boolean'],
      'wholesale_profile' => ['required', 'integer', 'min:0'],
      'total_sum' => ['required', 'numeric', 'decimal:0,2', 'between:0,999999.99'],
      'email_verified_at' => ['nullable', 'date'],
    ];
  }
}
