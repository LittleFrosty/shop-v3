<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\ListCartDTO;
use App\Features\Cart\Models\Cart;

class ListCartQuery{
  public function handle(ListCartDTO $dto): mixed{
    return Cart::query()->get();
  }
}
