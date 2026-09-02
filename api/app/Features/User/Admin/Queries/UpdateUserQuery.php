<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\UpdateUserDTO;
use App\Features\User\Models\User;

class UpdateUserQuery{
  public function handle(UpdateUserDTO $dto): mixed{
    return User::query()->get();
  }
}
