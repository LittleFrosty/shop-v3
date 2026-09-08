<?php

namespace App\Features\Cart\Admin\Requests;

use App\Enums\CartStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListCartRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'status' => ['sometimes', 'string', Rule::enum(CartStatus::class)],
      'email' => ['sometimes', 'string', 'max:256'],
      'name' => ['sometimes', 'string', 'max:256'],
      'created_from' => ['sometimes', 'date'],
      'created_to' => ['sometimes', 'date', 'after_or_equal:created_from'],
    ];
  }
}
