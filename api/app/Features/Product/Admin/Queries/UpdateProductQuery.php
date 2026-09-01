<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\UpdateProductDTO;
use App\Features\Product\Models\Product;

class UpdateProductQuery{
  public function handle(UpdateProductDTO $dto): mixed{
      return Product::query()->get();
  }
}
