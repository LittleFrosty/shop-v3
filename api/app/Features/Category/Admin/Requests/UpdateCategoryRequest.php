<?php

namespace App\Features\Category\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest{
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
      'id'                => ['required', 'integer', 'exists:category,id'],
      'top'               => ['sometimes', 'boolean'],
      'status'            => ['sometimes', 'string', Rule::enum(Status::class)],
      'image'             => ['sometimes', 'nullable', 'string'],
      'slug'              => ['sometimes', 'string', 'max:256'],
      'views'             => ['sometimes', 'integer', 'min:0'],
      'parent_id'         => ['sometimes', 'nullable', 'integer', 'min:0', Rule::notIn([$this->route('id')])],
      'depth'             => ['sometimes', 'integer', 'min:0'],
      'sort_order'        => ['sometimes', 'integer'],
      'title'             => ['sometimes', 'string', 'max:256'],
      'description'       => ['sometimes', 'string'],
      'meta_title'        => ['sometimes', 'string', 'max:256'],
      'meta_description'  => ['sometimes', 'string', 'max:256'],
    ];
  }

  public function messages(): array{
    return [
      'id.required' => 'Category ID is required.',
      'id.integer'  => 'Category ID must be a number.',
      'id.exists'   => 'The selected Category does not exist.',
    ];
  }
}
