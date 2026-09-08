<?php

namespace App\Features\Product\Admin\Actions;

use App\Features\Product\Admin\DTOs\ListProductDTO;
use App\Features\Product\Admin\Queries\ListProductQuery;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProductAction{
  public function __construct(private ListProductQuery $query){}

  public function handle(ListProductDTO $dto): LengthAwarePaginator{
    return $this->query->handle($dto);
  }
}
