<?php

namespace App\Features\User\Admin\Actions;

use App\Features\User\Admin\DTOs\UpdateUserDTO;
use App\Features\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction{
  public function handle(UpdateUserDTO $dto): User{
    $user = User::query()->findOrFail($dto->id);
    $attributes = $dto->attributes;

    if (array_key_exists('password', $attributes)) {
      $attributes['password'] = Hash::make($attributes['password']);
    }

    $user->update($attributes);

    return $user->refresh();
  }
}
