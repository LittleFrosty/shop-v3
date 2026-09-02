<?php

namespace App\Features\Media\Admin\Queries;

use App\Features\Media\Admin\DTOs\ShowMediaDTO;
use App\Features\Media\Models\Media;

class ShowMediaQuery{
  public function handle(ShowMediaDTO $dto): mixed{
    return Media::query()->get();
  }
}
