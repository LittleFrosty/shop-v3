<?php

namespace App\Features\User\Admin\Queries;

use App\Features\User\Admin\DTOs\ListUserDTO;
use App\Features\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUserQuery{
  public function handle(ListUserDTO $dto): LengthAwarePaginator{
    return User::query()
      ->when($dto->name !== null, fn ($query) => $query->where('name', 'like', "%{$dto->name}%"))
      ->when($dto->email !== null, fn ($query) => $query->where('email', 'like', "%{$dto->email}%"))
      ->when($dto->status !== null, fn ($query) => $query->where('status', $dto->status))
      ->orderByDesc('id')
      ->paginate(50);
  }
}
