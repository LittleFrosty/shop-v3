<?php

namespace App\Features\Product\Admin\Actions;

use App\Features\Product\Admin\DTOs\DeleteProductDTO;
use App\Features\Product\Admin\Queries\DeleteProductQuery;
use Illuminate\Support\Facades\DB;

class DeleteProductAction{
  public function __construct(private DeleteProductQuery $query){}

  public function handle(DeleteProductDTO $dto): void{
    DB::transaction(function () use ($dto): void {
      $product = $this->query->handle($dto);
      $product->categories()->delete();
      $product->description()->delete();
      $product->delete();
    });
  }
}
