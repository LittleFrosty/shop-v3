<?php

namespace App\Features\User\Admin\Actions;

use App\Features\User\Admin\DTOs\ListUserDTO;
use App\Features\User\Admin\Queries\ListUserQuery;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUserAction{
  public function __construct(private readonly ListUserQuery $query){}

  public function handle(ListUserDTO $dto): LengthAwarePaginator{
    return $this->query->handle($dto);
  }
}
