<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\ResourceUserDTO;
use App\Features\User\Models\User;

class ResourceUserQuery{
  public function handle(ResourceUserDTO $dto): mixed{
    return User::query()->get();
  }
}
