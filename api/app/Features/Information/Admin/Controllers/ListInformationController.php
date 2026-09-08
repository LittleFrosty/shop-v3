<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\ListInformationAction;
use App\Features\Information\Admin\DTOs\ListInformationDTO;
use App\Features\Information\Admin\Requests\ListInformationRequest;
use App\Features\Information\Admin\Resources\ListInformationResource;
use App\Http\Controllers\Controller;

class ListInformationController extends Controller{
  public function __invoke(ListInformationRequest $request, ListInformationAction $action): array{
    $paginator = $action->handle(ListInformationDTO::fromArray($request->validated()));

    return [
      'data' => ListInformationResource::collection($paginator->items()),
      'meta' => [
        'current_page' => $paginator->currentPage(),
        'last_page' => $paginator->lastPage(),
        'per_page' => $paginator->perPage(),
        'total' => $paginator->total(),
      ],
    ];
  }
}
