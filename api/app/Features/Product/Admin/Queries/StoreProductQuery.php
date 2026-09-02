<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\StoreProductDTO;
use App\Features\Product\Models\Product;

class StoreProductQuery
{
    public function handle(StoreProductDTO $dto): mixed
    {
        return Product::query()->get();
    }
}
