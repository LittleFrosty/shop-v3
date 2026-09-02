<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\UpdateCategoryDTO;
use App\Features\Category\Models\Category;

class UpdateCategoryQuery{
  public function handle(UpdateCategoryDTO $dto): mixed{
    return Category::query()->get();
  }
}
