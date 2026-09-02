<?php

namespace App\Features\Cart\Admin\Queries;

use App\Features\Cart\Admin\DTOs\ResourceCartDTO;
use App\Features\Cart\Models\Cart;

class ResourceCartQuery{
  public function handle(ResourceCartDTO $dto): mixed{
    return Cart::query()->get();
  }
}
