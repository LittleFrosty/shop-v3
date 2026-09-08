<?php

namespace App\Features\Category\Admin\Actions;

use App\Enums\Status;
use App\Features\Category\Admin\DTOs\UpdateCategoryDTO;
use App\Features\Category\Models\Category;
use Illuminate\Support\Facades\DB;

class UpdateCategoryAction{

  public function handle(UpdateCategoryDTO $dto): Category{
    return DB::transaction(function() use($dto): Category{
      $category = Category::query()->findOrFail($dto->id);
      $attributes = $dto->category;

      if (isset($attributes['status'])){
        $attributes['status'] = Status::from($attributes['status'])->value;
      }

      if ($attributes !== []){
        $category->update($attributes);
      }

      if ($dto->description !== []){
        $category->description()->updateOrCreate(
          ['category_id' => $category->id],
          $dto->description,
        );
      }

      return $category->fresh('description');
    });
  }
}
