<?php

namespace App\Features\Information\Admin\Actions;

use App\Features\Information\Admin\DTOs\StoreInformationDTO;
use App\Features\Information\Models\Information;

class StoreInformationAction{
  public function handle(StoreInformationDTO $dto): Information{
    return Information::query()->create($dto->toArray());
  }
}
