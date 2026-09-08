<?php

namespace App\Features\Product\Admin\Actions;

use App\Features\Product\Admin\DTOs\UpdateProductDTO;
use App\Features\Product\Admin\Queries\UpdateProductQuery;
use App\Features\Product\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdateProductAction{
  public function __construct(private UpdateProductQuery $query){}

  public function handle(UpdateProductDTO $dto): Product{
    return DB::transaction(function () use ($dto): Product {
      $product = $this->query->handle($dto);

      if ($dto->product !== []) {
        $product->update($dto->product);
      }

      if ($dto->description !== []) {
        $product->description()->updateOrCreate(
          ['product_id' => $product->id],
          $dto->description,
        );
      }

      if ($dto->categoryIds !== null) {
        $product->categories()->delete();
        $product->categories()->createMany(
          array_map(fn (int $categoryId): array => ['category_id' => $categoryId], $dto->categoryIds)
        );
      }

      return $product->fresh(['description', 'categories']);
    });
  }
}
