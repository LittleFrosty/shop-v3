<?php

namespace App\Features\Product\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      "id"                  => $this->id,
      "price"               => $this->price,
      "discount"            => $this->discount,
      "wholesale"           => $this->wholesale,
      "model"               => $this->model,
      "barcode"             => $this->barcode,
      "weight"              => $this->weight,
      "youtube"             => $this->youtube,
      "quantity"            => $this->quantity,
      "bundle_of_models"    => $this->bundle_of_models,
      "out_of_stock_status" => $this->out_of_stock_status,
      "brand_id"            => $this->brand_id,
      "status"              => $this->status,
      "sort_order"          => $this->sort_order,
      "description"         => $this->description->only(['title','description','meta_title', 'meta_description','tags']),
      "categories"          => collect($this->categories)->pluck('category_id')->toArray(),
    ];
  }
}
