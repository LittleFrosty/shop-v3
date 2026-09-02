<?php

namespace App\Features\Admin\Admin\Queries;

use App\Features\Admin\Admin\DTOs\StoreAdminDTO;
use App\Features\Admin\Models\Admin;

class StoreAdminQuery{
  public function handle(StoreAdminDTO $dto): mixed{
    return Admin::query()->get();
  }
}
