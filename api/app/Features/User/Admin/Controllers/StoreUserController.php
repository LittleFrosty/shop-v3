<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\StoreUserAction;
use App\Features\User\Admin\DTOs\StoreUserDTO;
use App\Features\User\Admin\Requests\StoreUserRequest;
use App\Features\User\Admin\Resources\ShowUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreUserController extends Controller{
  public function __invoke(StoreUserRequest $request, StoreUserAction $action): JsonResponse{
    $user = $action->handle(StoreUserDTO::fromArray($request->validated()));

    return ShowUserResource::make($user)
      ->response()
      ->setStatusCode(Response::HTTP_CREATED);
  }
}
