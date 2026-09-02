<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\StoreCartDTO;
use App\Features\Cart\Models\Cart;

class StoreCartQuery{
  public function handle(StoreCartDTO $dto): mixed{
    return Cart::query()->get();
  }
}
