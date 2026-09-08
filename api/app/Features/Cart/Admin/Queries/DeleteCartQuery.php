<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\DeleteCartDTO;
use App\Features\Cart\Models\Cart;

class DeleteCartQuery{
  public function handle(DeleteCartDTO $dto): Cart{
    return Cart::query()->findOrFail($dto->id);
  }
}
