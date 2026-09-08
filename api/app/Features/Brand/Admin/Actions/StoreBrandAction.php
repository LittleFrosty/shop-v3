<?php

namespace App\Features\Brand\Admin\Actions;

use App\Features\Brand\Admin\DTOs\StoreBrandDTO;
use App\Features\Brand\Models\Brand;

class StoreBrandAction{
  public function handle(StoreBrandDTO $dto): Brand{
    return Brand::query()->create($dto->toArray());
  }
}
