<?php

namespace App\Features\Admin\Admin\Queries;

use App\Features\Admin\Admin\DTOs\ListAdminDTO;
use App\Features\Admin\Models\Admin;

class ListAdminQuery{
  public function handle(ListAdminDTO $dto): mixed{
    return Admin::query()->get();
  }
}
