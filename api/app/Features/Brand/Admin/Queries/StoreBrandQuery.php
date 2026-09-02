<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\StoreBrandDTO;
use App\Features\Brand\Models\Brand;

class StoreBrandQuery{
  public function handle(StoreBrandDTO $dto): mixed{
    return Brand::query()->get();
  }
}
