<?php

namespace App\Features\Media\Admin\Queries;

use App\Features\Media\Admin\DTOs\ListMediaDTO;
use App\Features\Media\Models\Media;

class ListMediaQuery{
  public function handle(ListMediaDTO $dto): mixed{
    return Media::query()->get();
  }
}
