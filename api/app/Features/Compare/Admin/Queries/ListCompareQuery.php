<?php

namespace App\Features\Compare\Admin\Queries;

use App\Features\Compare\Admin\DTOs\ListCompareDTO;
use App\Features\Compare\Models\Compare;

class ListCompareQuery{
  public function handle(ListCompareDTO $dto): mixed{
    return Compare::query()->get();
  }
}
