<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\StoreProductDTO;
use App\Features\Product\Models\Product;

class StoreProductQuery{
  public function handle(StoreProductDTO $dto): Product{
    return Product::query()->create([
      'price' => $dto->price,
      'discount' => $dto->discount,
      'wholesale' => $dto->wholesale,
      'model' => $dto->model,
      'barcode' => $dto->barcode,
      'weight' => $dto->weight,
      'youtube' => $dto->youtube,
      'quantity' => $dto->quantity,
      'bundle_of_models' => $dto->bundleOfModels,
      'out_of_stock_status' => $dto->outOfStockStatus,
      'brand_id' => $dto->brandId,
      'status' => $dto->status->value,
      'url' => $dto->url,
      'sort_order' => $dto->sortOrder,
    ]);
  }
}
