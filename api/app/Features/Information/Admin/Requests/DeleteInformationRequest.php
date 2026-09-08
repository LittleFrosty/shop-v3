<?php

namespace App\Features\Information\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteInformationRequest extends FormRequest{
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
      'id' => ['required', 'integer', 'exists:information,id'],
    ];
  }
}
