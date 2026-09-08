<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\UpdateUserAction;
use App\Features\User\Admin\DTOs\UpdateUserDTO;
use App\Features\User\Admin\Requests\UpdateUserRequest;
use App\Features\User\Admin\Resources\ShowUserResource;
use App\Http\Controllers\Controller;

class UpdateUserController extends Controller{
  public function __invoke(UpdateUserRequest $request, UpdateUserAction $action): ShowUserResource{
    $user = $action->handle(UpdateUserDTO::fromArray($request->validated()));

    return ShowUserResource::make($user);
  }
}
