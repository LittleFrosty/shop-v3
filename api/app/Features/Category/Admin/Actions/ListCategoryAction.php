<?php

namespace App\Features\Category\Admin\Actions;

use App\Features\Category\Admin\DTOs\ListCategoryDTO;
use App\Features\Category\Admin\Queries\ListCategoryQuery;
use App\Features\Category\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class ListCategoryAction{

  public function __construct(private ListCategoryQuery $query){}
  
  public function handle(ListCategoryDTO $dto):LengthAwarePaginator {
    return $this->query->handle($dto);
  }
}
