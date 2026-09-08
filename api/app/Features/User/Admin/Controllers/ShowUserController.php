<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\ShowUserAction;
use App\Features\User\Admin\DTOs\ShowUserDTO;
use App\Features\User\Admin\Requests\ShowUserRequest;
use App\Features\User\Admin\Resources\ShowUserResource;
use App\Http\Controllers\Controller;

class ShowUserController extends Controller{
  public function __invoke(ShowUserRequest $request, ShowUserAction $action): ShowUserResource{
    $user = $action->handle(ShowUserDTO::fromArray($request->validated()));

    return ShowUserResource::make($user);
  }
}
