<?php

namespace App\Features\Admin\Admin\Queries;

use App\Features\Admin\Admin\DTOs\UpdateAdminDTO;
use App\Features\Admin\Models\Admin;

class UpdateAdminQuery{
  public function handle(UpdateAdminDTO $dto): mixed{
    return Admin::query()->get();
  }
}
