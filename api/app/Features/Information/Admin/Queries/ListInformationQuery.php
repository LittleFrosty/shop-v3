<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\ListInformationDTO;
use App\Features\Information\Models\Information;

class ListInformationQuery{
  public function handle(ListInformationDTO $dto): mixed{
    return Information::query()->get();
  }
}
