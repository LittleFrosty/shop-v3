<?php

namespace App\Features\Brand\Admin\Actions;

use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Admin\Queries\ListBrandQuery;
use Illuminate\Pagination\LengthAwarePaginator;

class ListBrandAction{
  public function __construct(private readonly ListBrandQuery $query){}

  public function handle(ListBrandDTO $dto): LengthAwarePaginator{
    return $this->query->handle($dto);
  }
}
