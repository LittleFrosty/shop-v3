<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\ListUserDTO;
use App\Features\User\Models\User;

class ListUserQuery{
  public function handle(ListUserDTO $dto): User{
    return User::get();
  }
}
