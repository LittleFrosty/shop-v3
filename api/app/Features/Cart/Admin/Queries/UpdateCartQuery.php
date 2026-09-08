<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\UpdateCartDTO;
use App\Features\Cart\Models\Cart;

class UpdateCartQuery{
  public function handle(UpdateCartDTO $dto): Cart{
    return Cart::query()->findOrFail($dto->id);
  }
}
