<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\ShowInformationDTO;
use App\Features\Information\Models\Information;

class ShowInformationQuery{
  public function handle(ShowInformationDTO $dto): mixed{
    return Information::query()->get();
  }
}
