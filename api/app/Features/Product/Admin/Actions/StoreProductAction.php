<?php

namespace App\Features\Product\Admin\Actions;

use App\Features\Product\Admin\DTOs\StoreProductDTO;
use App\Features\Product\Admin\Queries\StoreProductQuery;
use App\Features\Product\Models\Product;
use Illuminate\Support\Facades\DB;

class StoreProductAction{
  public function __construct(private StoreProductQuery $query){}

  public function handle(StoreProductDTO $dto): Product{
    return DB::transaction(function () use ($dto): Product {
      $product = $this->query->handle($dto);

      $product->description()->create([
        'title' => $dto->title,
        'description' => $dto->description,
        'meta_title' => $dto->metaTitle,
        'meta_description' => $dto->metaDescription,
        'tags' => $dto->tags,
      ]);

      $product->categories()->createMany(
        array_map(fn (int $categoryId): array => ['category_id' => $categoryId], $dto->categoryIds)
      );

      return $product->load(['description', 'categories']);
    });
  }
}
