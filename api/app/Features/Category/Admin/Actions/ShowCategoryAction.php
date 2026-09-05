<?php

namespace App\Features\Category\Admin\Actions;

use App\Features\Category\Admin\DTOs\ShowCategoryDTO;
use App\Features\Category\Admin\Queries\ShowCategoryQuery;
use App\Features\Category\Models\Category;

class ShowCategoryAction{

  public function __construct(private ShowCategoryQuery $query){}
  
  public function handle(ShowCategoryDTO $dto):Category{
    return $this->query->handle($dto);
  }
}
