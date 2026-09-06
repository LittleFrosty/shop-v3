<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\ListCategoryAction;
use App\Features\Category\Admin\DTOs\ListCategoryDTO;
use App\Features\Category\Admin\Requests\ListCategoryRequest;
use App\Features\Category\Admin\Resources\ListCategoryResource;
use App\Http\Controllers\Controller;

class ListCategoryController extends Controller{
  public function __invoke(ListCategoryRequest $request,ListCategoryAction $action) {
    $dto = ListCategoryDTO::fromArray($request->validated());
    $paginator = $action->handle($dto);

    return [
      'data' => ListCategoryResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
