<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\ListCartAction;
use App\Features\Cart\Admin\DTOs\ListCartDTO;
use App\Features\Cart\Admin\Requests\ListCartRequest;
use App\Features\Cart\Admin\Resources\ListCartResource;
use App\Http\Controllers\Controller;

class ListCartController extends Controller{
  public function __invoke(ListCartRequest $request, ListCartAction $action): array{
    $paginator = $action->handle(ListCartDTO::fromArray($request->validated()));

    return [
      'data' => ListCartResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
