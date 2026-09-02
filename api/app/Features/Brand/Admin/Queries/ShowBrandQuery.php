<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\ShowBrandDTO;
use App\Features\Brand\Models\Brand;

class ShowBrandQuery{
  public function handle(ShowBrandDTO $dto): mixed{
    return Brand::query()->get();
  }
}
