<?php

namespace App\Features\Admin\Admin\Queries;

use App\Features\Admin\Admin\DTOs\ResourceAdminDTO;
use App\Features\Admin\Models\Admin;

class ResourceAdminQuery{
  public function handle(ResourceAdminDTO $dto): mixed{
    return Admin::query()->get();
  }
}
