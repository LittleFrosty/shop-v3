<?php

namespace App\Features\Product\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'price' => ['required', 'numeric', 'min:0'],
      'discount' => ['required', 'numeric', 'min:0'],
      'wholesale' => ['required', 'numeric', 'min:0'],
      'model' => ['required', 'string', 'max:256', 'unique:product,model'],
      'barcode' => ['nullable', 'string', 'max:256', 'unique:product,barcode'],
      'weight' => ['required', 'numeric', 'min:0'],
      'youtube' => ['nullable', 'string', 'max:256'],
      'quantity' => ['required', 'integer', 'min:0'],
      'bundle_of_models' => ['nullable', 'string'],
      'out_of_stock_status' => ['required', 'integer', 'min:0'],
      'brand_id' => ['nullable', 'integer', 'exists:brand,id'],
      'status' => ['required', 'string', Rule::enum(Status::class)],
      'url' => ['required', 'string', 'max:256', 'unique:product,url'],
      'sort_order' => ['required', 'integer'],
      'title' => ['required', 'string', 'max:256'],
      'description' => ['required', 'string'],
      'meta_title' => ['nullable', 'string', 'max:255'],
      'meta_description' => ['nullable', 'string', 'max:255'],
      'tags' => ['required', 'string'],
      'category_ids' => ['required', 'array'],
      'category_ids.*' => ['integer', 'distinct', 'exists:category,id'],
    ];
  }
}
