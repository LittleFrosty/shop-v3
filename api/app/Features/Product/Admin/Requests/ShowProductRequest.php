<?php

namespace App\Features\Product\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowProductRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge([
      'id' => $this->route('id'),
    ]);
  }

  public function rules(): array{
    return [
      'id' => ['required', 'integer', 'exists:product,id'],
    ];
  }

  public function messages(): array{
    return [
      'id.required' => 'Product ID is required.',
      'id.integer'  => 'Product ID must be a number.',
      'id.exists'   => 'The selected Product does not exist.',
    ];
  }
}