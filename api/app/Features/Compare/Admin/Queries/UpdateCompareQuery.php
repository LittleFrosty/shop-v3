<?php

namespace App\Features\Compare\Admin\Queries;

use App\Features\Compare\Admin\DTOs\UpdateCompareDTO;
use App\Features\Compare\Models\Compare;

class UpdateCompareQuery{
  public function handle(UpdateCompareDTO $dto): mixed{
    return Compare::query()->get();
  }
}
