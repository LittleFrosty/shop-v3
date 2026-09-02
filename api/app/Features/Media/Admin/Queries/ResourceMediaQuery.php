<?php

namespace App\Features\Media\Admin\Queries;

use App\Features\Media\Admin\DTOs\ResourceMediaDTO;
use App\Features\Media\Models\Media;

class ResourceMediaQuery{
  public function handle(ResourceMediaDTO $dto): mixed{
    return Media::query()->get();
  }
}
