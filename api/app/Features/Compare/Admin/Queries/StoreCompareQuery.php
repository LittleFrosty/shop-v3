<?php

namespace App\Features\Compare\Admin\Queries;

use App\Features\Compare\Admin\DTOs\StoreCompareDTO;
use App\Features\Compare\Models\Compare;

class StoreCompareQuery{
  public function handle(StoreCompareDTO $dto): mixed{
    return Compare::query()->get();
  }
}
