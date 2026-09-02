<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\ListCategoryDTO;
use App\Features\Category\Models\Category;

class ListCategoryQuery{
  public function handle(ListCategoryDTO $dto): mixed{
    return Category::query()->get();
  }
}
