<?php

namespace App\Features\Product\Admin\Queries;

use App\Features\Product\Admin\DTOs\ListProductDTO;
use App\Features\Product\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProductQuery{
  public function handle(ListProductDTO $dto): LengthAwarePaginator{
    return Product::query()
      ->with(['description', 'categories'])
      ->when($dto->title !== null, fn ($query) => $query->whereHas(
        'description',
        fn ($description) => $description->where('title', 'like', '%'.$dto->title.'%')
      ))
      ->when($dto->model !== null, fn ($query) => $query->where('model', 'like', '%'.$dto->model.'%'))
      ->when($dto->status !== null, fn ($query) => $query->where('status', $dto->status->value))
      ->when($dto->brandId !== null, fn ($query) => $query->where('brand_id', $dto->brandId))
      ->orderBy('sort_order')
      ->orderBy('id')
      ->paginate(50);
  }
}
