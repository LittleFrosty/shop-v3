<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\ListUserAction;
use App\Features\User\Admin\DTOs\ListUserDTO;
use App\Features\User\Admin\Requests\ListUserRequest;
use App\Features\User\Admin\Resources\ListUserResource;
use App\Http\Controllers\Controller;

class ListUserController extends Controller{
  public function __invoke(ListUserRequest $request, ListUserAction $action): array{
    $paginator = $action->handle(ListUserDTO::fromArray($request->validated()));

    return [
      'data' => ListUserResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
