<?php

namespace App\Features\Media\Admin\Queries;

use App\Features\Media\Admin\DTOs\UpdateMediaDTO;
use App\Features\Media\Models\Media;

class UpdateMediaQuery{
  public function handle(UpdateMediaDTO $dto): mixed{
    return Media::query()->get();
  }
}
