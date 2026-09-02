<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\StoreUserDTO;
use App\Features\User\Models\User;

class StoreUserQuery{
  public function handle(StoreUserDTO $dto): mixed{
    return User::query()->get();
  }
}
