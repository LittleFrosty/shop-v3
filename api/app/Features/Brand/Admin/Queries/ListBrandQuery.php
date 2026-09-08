<?php

namespace App\Features\Brand\Admin\Queries;

use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;

class ListBrandQuery{
  public function handle(ListBrandDTO $dto): LengthAwarePaginator{
    $brands = Brand::query();

    if ($dto->title !== null) {
      $brands->where('title', 'like', '%'.$dto->title.'%');
    }

    if ($dto->status !== null) {
      $brands->where('status', $dto->status);
    }

    return $brands
      ->orderBy('sort_order')
      ->orderBy('id')
      ->paginate(50);
  }
}
