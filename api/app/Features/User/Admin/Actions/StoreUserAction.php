<?php

namespace App\Features\User\Admin\Actions;

use App\Features\User\Admin\DTOs\StoreUserDTO;
use App\Features\User\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserAction{
  public function handle(StoreUserDTO $dto): User{
    $attributes = $dto->toArray();
    $attributes['password'] = Hash::make($dto->password);

    return User::query()->create($attributes);
  }
}
