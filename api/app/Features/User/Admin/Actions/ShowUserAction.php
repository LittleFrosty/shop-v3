<?php

namespace App\Features\User\Admin\Actions;

use App\Features\User\Admin\DTOs\ShowUserDTO;
use App\Features\User\Admin\Queries\ShowUserQuery;
use App\Features\User\Models\User;

class ShowUserAction{
  public function __construct(private readonly ShowUserQuery $query){}

  public function handle(ShowUserDTO $dto): User{
    return $this->query->handle($dto);
  }
}
