<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\ResourceBrandDTO;
use App\Features\Brand\Models\Brand;

class ResourceBrandQuery{
  public function handle(ResourceBrandDTO $dto): mixed{
    return Brand::query()->get();
  }
}
