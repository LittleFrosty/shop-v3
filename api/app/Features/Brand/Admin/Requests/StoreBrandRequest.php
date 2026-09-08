<?php

namespace App\Features\Brand\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrandRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'title' => ['required', 'string', 'max:256'],
      'description' => ['required', 'string'],
      'meta_title' => ['required', 'string', 'max:256'],
      'meta_description' => ['required', 'string', 'max:255'],
      'sort_order' => ['required', 'integer', 'min:0'],
      'slug' => ['required', 'string', 'max:256', 'unique:brand,slug'],
      'image' => ['required', 'string', 'max:256'],
      'status' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }
}
