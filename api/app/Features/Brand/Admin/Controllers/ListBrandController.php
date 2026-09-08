<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\ListBrandAction;
use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Admin\Requests\ListBrandRequest;
use App\Features\Brand\Admin\Resources\ListBrandResource;
use App\Http\Controllers\Controller;

class ListBrandController extends Controller{
  public function __invoke(ListBrandRequest $request, ListBrandAction $action): array{
    $paginator = $action->handle(ListBrandDTO::fromArray($request->validated()));

    return [
      'data' => ListBrandResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
