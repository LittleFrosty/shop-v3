<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\DeleteProductDTO;
use App\Features\Product\Models\Product;

class DeleteProductQuery
{
    public function handle(DeleteProductDTO $dto): mixed
    {
        return Product::query()->get();
    }
}
