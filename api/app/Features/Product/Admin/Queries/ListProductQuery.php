<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\ListProductDTO;
use App\Features\Product\Models\Product;

class ListProductQuery
{
    public function handle(ListProductDTO $dto): mixed
    {
        return Product::query()->get();
    }
}
