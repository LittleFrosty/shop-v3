<?php

namespace App\Features\Information\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInformationRequest extends FormRequest{
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
      'title' => ['sometimes', 'string', 'max:256'],
      'thumbnail' => ['sometimes', 'nullable', 'string', 'max:256'],
      'description' => ['sometimes', 'string'],
      'status' => ['sometimes', 'integer', Rule::in([0, 1])],
      'agreements_at_order' => ['sometimes', 'integer', Rule::in([0, 1])],
      'agreement_at_contacts' => ['sometimes', 'integer', Rule::in([0, 1])],
      'show_in_footer' => ['sometimes', 'integer', Rule::in([0, 1])],
      'sort_order' => ['sometimes', 'integer', 'min:0'],
    ];
  }
}
