<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\ResourceUserAction;
use App\Features\User\Admin\DTOs\ResourceUserDTO;
use App\Features\User\Admin\Requests\ResourceUserRequest;
use App\Http\Controllers\Controller;

class ResourceUserController extends Controller{
  public function __invoke(ResourceUserRequest $request,ResourceUserAction $action) {
    $dto = ResourceUserDTO::fromArray($request->validated());
    $resrouce = new ResourceUserResource($action->handle($dto));
    return $resource;
  }
}