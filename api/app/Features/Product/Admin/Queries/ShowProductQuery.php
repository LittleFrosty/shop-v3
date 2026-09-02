<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\ShowProductDTO;
use App\Features\Product\Models\Product;

class ShowProductQuery{
  public function handle(ShowProductDTO $dto): Product{
    return Product::query()->with(['description','categories'])->where('id',$dto->id)->first();
  }
}
