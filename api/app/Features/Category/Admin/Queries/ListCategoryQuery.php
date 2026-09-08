<?php

namespace App\Features\Category\Admin\Queries;

use App\Features\Category\Admin\DTOs\ListCategoryDTO;
use App\Features\Category\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class ListCategoryQuery{
  public function handle(ListCategoryDTO $dto): LengthAwarePaginator{
    $categories = Category::query()->where('parent_id', 0)->with([
      'description',
      'children.description',
      'children.children.description',
    ]);

    if ($dto->title !== null){
      $categories->whereHas('description', function($query) use ($dto){
        $query->where('title','LIKE',"%" . $dto->title . "%");
      });
    }

    if ($dto->status !== null) {
      $categories->where('status', $dto->status);
    }

    return $categories->orderBy('sort_order')->paginate(50);
  } 
}
