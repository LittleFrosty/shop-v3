<?php

namespace App\Features\Compare\Admin\Queries;

use App\Features\Compare\Admin\DTOs\ShowCompareDTO;
use App\Features\Compare\Models\Compare;

class ShowCompareQuery{
  public function handle(ShowCompareDTO $dto): mixed{
    return Compare::query()->get();
  }
}
