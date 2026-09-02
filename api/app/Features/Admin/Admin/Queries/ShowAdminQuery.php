<?php

namespace App\Features\Admin\Admin\Queries;

use App\Features\Admin\Admin\DTOs\ShowAdminDTO;
use App\Features\Admin\Models\Admin;

class ShowAdminQuery{
  public function handle(ShowAdminDTO $dto): mixed{
    return Admin::query()->get();
  }
}
