<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\StoreCategoryDTO;
use App\Features\Category\Models\Category;

class StoreCategoryQuery{
  public function handle(StoreCategoryDTO $dto): mixed{
    return Category::query()->get();
  }
}
