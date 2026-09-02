<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\UpdateInformationDTO;
use App\Features\Information\Models\Information;

class UpdateInformationQuery{
  public function handle(UpdateInformationDTO $dto): mixed{
    return Information::query()->get();
  }
}
