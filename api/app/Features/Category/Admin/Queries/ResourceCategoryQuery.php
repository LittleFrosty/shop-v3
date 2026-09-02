<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\ResourceCategoryDTO;
use App\Features\Category\Models\Category;

class ResourceCategoryQuery{
  public function handle(ResourceCategoryDTO $dto): mixed{
    return Category::query()->get();
  }
}
