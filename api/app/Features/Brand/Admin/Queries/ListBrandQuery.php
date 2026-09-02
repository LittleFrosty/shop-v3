<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Models\Brand;

class ListBrandQuery{
  public function handle(ListBrandDTO $dto): mixed{
    return Brand::query()->get();
  }
}
