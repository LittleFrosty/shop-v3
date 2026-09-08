<?php

namespace App\Features\Product\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListProductRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'title' => ['sometimes', 'string', 'max:256'],
      'model' => ['sometimes', 'string', 'max:256'],
      'status' => ['sometimes', 'string', Rule::enum(Status::class)],
      'brand_id' => ['sometimes', 'integer', 'exists:brand,id'],
    ];
  }
}
