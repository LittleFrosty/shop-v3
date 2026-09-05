<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\ShowCategoryDTO;
use App\Features\Category\Models\Category;

class ShowCategoryQuery{
  public function handle(ShowCategoryDTO $dto): Category{
    return Category::query()
    ->with(['description'])
    ->where('id',$dto->id)->first();
  }
}
