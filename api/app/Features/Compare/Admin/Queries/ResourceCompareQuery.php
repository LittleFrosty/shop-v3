<?php

namespace App\Features\Compare\Admin\Queries;

use App\Features\Compare\Admin\DTOs\ResourceCompareDTO;
use App\Features\Compare\Models\Compare;

class ResourceCompareQuery{
  public function handle(ResourceCompareDTO $dto): mixed{
    return Compare::query()->get();
  }
}
