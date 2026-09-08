<?php

namespace App\Features\Brand\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest{
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
      'id' => ['required', 'integer', 'exists:brand,id'],
      'title' => ['sometimes', 'string', 'max:256'],
      'description' => ['sometimes', 'string'],
      'meta_title' => ['sometimes', 'string', 'max:256'],
      'meta_description' => ['sometimes', 'string', 'max:255'],
      'sort_order' => ['sometimes', 'integer', 'min:0'],
      'slug' => [
        'sometimes',
        'string',
        'max:256',
        Rule::unique('brand', 'slug')->ignore($this->route('id')),
      ],
      'image' => ['sometimes', 'string', 'max:256'],
      'status' => ['sometimes', 'integer', Rule::in([0, 1])],
    ];
  }
}
