<?php

namespace App\Features\Cart\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCartRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge(['id' => $this->route('id')]);
  }

  public function rules(): array{
    return ['id' => ['required', 'integer', 'exists:cart,id']];
  }
}
