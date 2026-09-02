<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\UpdateBrandDTO;
use App\Features\Brand\Models\Brand;

class UpdateBrandQuery{
  public function handle(UpdateBrandDTO $dto): mixed{
    return Brand::query()->get();
  }
}
