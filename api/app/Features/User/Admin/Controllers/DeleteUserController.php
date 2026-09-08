<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\DeleteUserAction;
use App\Features\User\Admin\DTOs\DeleteUserDTO;
use App\Features\User\Admin\Requests\DeleteUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteUserController extends Controller{
  public function __invoke(DeleteUserRequest $request, DeleteUserAction $action): Response{
    $action->handle(DeleteUserDTO::fromArray($request->validated()));

    return response()->noContent();
  }
}
