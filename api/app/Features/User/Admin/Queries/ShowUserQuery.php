<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\ShowUserDTO;
use App\Features\User\Models\User;

class ShowUserQuery{
  public function handle(ShowUserDTO $dto): User{
    return User::get();
  }
}
