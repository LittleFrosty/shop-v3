<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\ListProductAction;
use App\Features\Product\Admin\DTOs\ListProductDTO;
use App\Features\Product\Admin\Requests\ListProductRequest;
use App\Features\Product\Admin\Resources\ListProductResource;
use App\Http\Controllers\Controller;

class ListProductController extends Controller{
  public function __invoke(
    ListProductRequest $request,
    ListProductAction $action
  ){
    $dto = ListProductDTO::fromArray(
      $request->validated()
    );

    $paginator = $action->handle($dto);

    return [
      'data' => ListProductResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
