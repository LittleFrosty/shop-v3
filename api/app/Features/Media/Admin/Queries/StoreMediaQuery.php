<?php

namespace App\Features\Media\Admin\Queries;

use App\Features\Media\Admin\DTOs\StoreMediaDTO;
use App\Features\Media\Models\Media;

class StoreMediaQuery{
  public function handle(StoreMediaDTO $dto): mixed{
    return Media::query()->get();
  }
}
