<?php

namespace App\Features\Category\Admin\Actions;

use App\Enums\Status;
use App\Features\Category\Admin\DTOs\StoreCategoryDTO;
use App\Features\Category\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreCategoryAction{

  public function __construct(){}
  
  public function handle(StoreCategoryDTO $dto){
    DB::transaction(function() use($dto) {
      $category = Category::create([
        'top'               => $dto->top,
        'status'            => $dto->status->value,
        'image'             => $dto->image,
        'parent_id'         => $dto->parent_id,
        'depth'             => $dto->depth,
        'sort_order'        => $dto->sort_order,
        'slug'              => Str::slug($dto->title),
      ]);

      $category->description()->create([
        'title'             => $dto->title,
        'description'       => $dto->description,
        'meta_title'        => $dto->meta_title,
        'meta_description'  => $dto->meta_description,
      ]);

    });
  }
}
