<?php

namespace App\Features\Brand\Admin\Actions;

use App\Features\Brand\Admin\DTOs\UpdateBrandDTO;
use App\Features\Brand\Models\Brand;

class UpdateBrandAction{
  public function handle(UpdateBrandDTO $dto): Brand{
    $brand = Brand::query()->findOrFail($dto->id);
    $brand->update($dto->changes());

    return $brand->refresh();
  }
}
