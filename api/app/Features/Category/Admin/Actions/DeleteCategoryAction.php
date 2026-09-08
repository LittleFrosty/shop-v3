<?php

namespace App\Features\Category\Admin\Actions;

use App\Features\Category\Models\Category;
use Illuminate\Support\Facades\DB;

class DeleteCategoryAction{

  public function handle(int $id): void{
    DB::transaction(function() use($id): void{
      $categoryIds = $this->descendantIds($id);

      DB::table('product_to_category')
        ->whereIn('category_id', $categoryIds)
        ->delete();
      DB::table('category_description')
        ->whereIn('category_id', $categoryIds)
        ->delete();

      Category::query()
        ->whereIn('id', array_reverse($categoryIds))
        ->delete();
    });
  }

  private function descendantIds(int $id): array{
    $ids = [$id];
    $childIds = Category::query()
      ->where('parent_id', $id)
      ->pluck('id')
      ->map(fn($childId): int => (int)$childId)
      ->all();

    foreach ($childIds as $childId){
      array_push($ids, ...$this->descendantIds($childId));
    }

    return $ids;
  }
}
