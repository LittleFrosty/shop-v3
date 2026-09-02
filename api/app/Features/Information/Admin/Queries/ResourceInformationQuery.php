<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\ResourceInformationDTO;
use App\Features\Information\Models\Information;

class ResourceInformationQuery{
  public function handle(ResourceInformationDTO $dto): mixed{
    return Information::query()->get();
  }
}
