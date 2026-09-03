<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Models\Brand;

class ListBrandQuery{
  public function handle(ListBrandDTO $dto): Brand{
    return Brand::get();
  }
}
