<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\ShowCategoryDTO;
use App\Features\Category\Models\Category;

class ShowCategoryQuery{
  public function handle(ShowCategoryDTO $dto): mixed{
    return Category::query()->get();
  }
}
