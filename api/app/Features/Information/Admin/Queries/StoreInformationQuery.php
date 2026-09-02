<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\StoreInformationDTO;
use App\Features\Information\Models\Information;

class StoreInformationQuery{
  public function handle(StoreInformationDTO $dto): mixed{
    return Information::query()->get();
  }
}
