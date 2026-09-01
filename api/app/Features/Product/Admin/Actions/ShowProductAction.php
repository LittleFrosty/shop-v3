<?php

namespace App\Features\Product\Admin\Actions;

use App\Features\Product\Admin\DTOs\ShowProductDTO;
use App\Features\Product\Admin\Queries\ShowProductQuery;
use App\Features\Product\Models\Product;

class ShowProductAction{
  public function __construct(private ShowProductQuery $query){}

  public function handle(ShowProductDTO $dto): Product{
    return $this->query->handle($dto);
  }
}
