<?php

namespace App\Features\Brand\Admin\Actions;

use App\Features\Brand\Admin\DTOs\DeleteBrandDTO;
use App\Features\Brand\Models\Brand;

class DeleteBrandAction{
  public function handle(DeleteBrandDTO $dto): void{
    Brand::query()->findOrFail($dto->id)->delete();
  }
}
