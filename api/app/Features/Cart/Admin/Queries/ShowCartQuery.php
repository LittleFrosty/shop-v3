<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\ShowCartDTO;
use App\Features\Cart\Models\Cart;

class ShowCartQuery{
  public function handle(ShowCartDTO $dto): mixed{
    return Cart::query()->get();
  }
}
