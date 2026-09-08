<?php

namespace App\Features\Product\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge(['id' => $this->route('id')]);
  }

  public function rules(): array{
    return [
      'id' => ['required', 'integer', 'exists:product,id'],
    ];
  }
}
