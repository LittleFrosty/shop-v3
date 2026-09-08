<?php

namespace App\Features\User\Admin\Actions;

use App\Features\User\Admin\DTOs\DeleteUserDTO;
use App\Features\User\Models\User;

class DeleteUserAction{
  public function handle(DeleteUserDTO $dto): void{
    User::query()->findOrFail($dto->id)->delete();
  }
}
