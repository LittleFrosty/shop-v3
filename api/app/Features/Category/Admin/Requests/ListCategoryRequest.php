<?php

namespace App\Features\Category\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListCategoryRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }
  public function rules(): array{
    return [
      "title"   => ['sometimes','string'],
      "status"  => ['sometimes','string', Rule::enum(Status::class)],
    ];
  }

  public function messages(): array{
    return [
      'title.string' => 'Title must be a string',
      'status.enum'  => 'Status is invalid.',
    ];
  }
}
