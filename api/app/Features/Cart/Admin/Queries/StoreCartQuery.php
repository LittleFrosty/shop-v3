<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\StoreCartDTO;
use App\Features\Cart\Models\Cart;

class StoreCartQuery{
  public function handle(StoreCartDTO $dto): Cart{
    return Cart::query()->create($dto->cartAttributes());
  }
}
