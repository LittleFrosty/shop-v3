<?php

namespace App\Features\Product\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource{
  public function toArray(Request $request): array{
    $description = $this->relationLoaded('description')
      ? $this->description
      : null;

    return [
      'id' => $this->id,
      'price' => $this->price,
      'discount' => $this->discount,
      'wholesale' => $this->wholesale,
      'model' => $this->model,
      'barcode' => $this->barcode,
      'weight' => $this->weight,
      'youtube' => $this->youtube,
      'quantity' => $this->quantity,
      'bundle_of_models' => $this->bundle_of_models,
      'out_of_stock_status' => $this->out_of_stock_status,
      'brand_id' => $this->brand_id,
      'status' => $this->status,
      'url' => $this->url,
      'sort_order' => $this->sort_order,
      'description' => $description ? [
        'id' => $description->id,
        'product_id' => $description->product_id,
        'title' => $description->title,
        'description' => $description->description,
        'meta_title' => $description->meta_title,
        'meta_description' => $description->meta_description,
        'tags' => $description->tags,
      ] : null,
      'categories' => $this->whenLoaded(
        'categories',
        fn () => $this->categories->pluck('category_id')->values()->all(),
      ),
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
      'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
    ];
  }
}
