<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\DeleteUserAction;
use App\Features\User\Admin\DTOs\DeleteUserDTO;
use App\Features\User\Admin\Requests\DeleteUserRequest;
use App\Http\Controllers\Controller;

class DeleteUserController extends Controller{
  public function __invoke(DeleteUserRequest $request,DeleteUserAction $action) {
    $dto = DeleteUserDTO::fromArray($request->validated());
    $resrouce = new DeleteUserResource($action->handle($dto));
    return $resource;
  }
}