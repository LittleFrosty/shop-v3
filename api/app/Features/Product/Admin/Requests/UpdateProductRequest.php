<?php

namespace App\Features\Product\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge(['id' => $this->route('id')]);
  }

  public function rules(): array{
    $productId = $this->route('id');

    return [
      'id' => ['required', 'integer', 'exists:product,id'],
      'price' => ['sometimes', 'numeric', 'min:0'],
      'discount' => ['sometimes', 'numeric', 'min:0'],
      'wholesale' => ['sometimes', 'numeric', 'min:0'],
      'model' => ['sometimes', 'string', 'max:256', Rule::unique('product', 'model')->ignore($productId)],
      'barcode' => ['sometimes', 'nullable', 'string', 'max:256', Rule::unique('product', 'barcode')->ignore($productId)],
      'weight' => ['sometimes', 'numeric', 'min:0'],
      'youtube' => ['sometimes', 'nullable', 'string', 'max:256'],
      'quantity' => ['sometimes', 'integer', 'min:0'],
      'bundle_of_models' => ['sometimes', 'nullable', 'string'],
      'out_of_stock_status' => ['sometimes', 'integer', 'min:0'],
      'brand_id' => ['sometimes', 'nullable', 'integer', 'exists:brand,id'],
      'status' => ['sometimes', 'string', Rule::enum(Status::class)],
      'url' => ['sometimes', 'string', 'max:256', Rule::unique('product', 'url')->ignore($productId)],
      'sort_order' => ['sometimes', 'integer'],
      'title' => ['sometimes', 'string', 'max:256'],
      'description' => ['sometimes', 'string'],
      'meta_title' => ['sometimes', 'nullable', 'string', 'max:255'],
      'meta_description' => ['sometimes', 'nullable', 'string', 'max:255'],
      'tags' => ['sometimes', 'string'],
      'category_ids' => ['sometimes', 'array'],
      'category_ids.*' => ['integer', 'distinct', 'exists:category,id'],
    ];
  }
}
