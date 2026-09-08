<?php

namespace App\Features\Brand\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListBrandRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'title' => ['sometimes', 'string', 'max:256'],
      'status' => ['sometimes', 'integer', Rule::in([0, 1])],
    ];
  }
}
