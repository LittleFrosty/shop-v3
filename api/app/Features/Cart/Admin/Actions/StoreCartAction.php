<?php

namespace App\Features\Cart\Admin\Actions;

use App\Features\Cart\Admin\DTOs\StoreCartDTO;
use App\Features\Cart\Admin\Queries\StoreCartQuery;
use App\Features\Cart\Models\Cart;
use Illuminate\Support\Facades\DB;

class StoreCartAction{
  public function __construct(private StoreCartQuery $query){}

  public function handle(StoreCartDTO $dto): Cart{
    return DB::transaction(function () use ($dto): Cart{
      $cart = $this->query->handle($dto);
      $cart->products()->createMany($dto->products);

      return $cart->load('products');
    });
  }
}
