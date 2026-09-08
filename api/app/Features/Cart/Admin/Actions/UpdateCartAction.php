<?php

namespace App\Features\Cart\Admin\Actions;

use App\Features\Cart\Admin\DTOs\UpdateCartDTO;
use App\Features\Cart\Admin\Queries\UpdateCartQuery;
use App\Features\Cart\Models\Cart;
use Illuminate\Support\Facades\DB;

class UpdateCartAction{
  public function __construct(private UpdateCartQuery $query){}

  public function handle(UpdateCartDTO $dto): Cart{
    return DB::transaction(function () use ($dto): Cart{
      $cart = $this->query->handle($dto);

      if ($dto->cart !== []) {
        $cart->update($dto->cart);
      }

      if ($dto->products !== null) {
        $cart->products()->delete();
        $cart->products()->createMany($dto->products);
      }

      return $cart->fresh('products');
    });
  }
}
