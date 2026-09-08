<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\StoreInformationAction;
use App\Features\Information\Admin\DTOs\StoreInformationDTO;
use App\Features\Information\Admin\Requests\StoreInformationRequest;
use App\Features\Information\Admin\Resources\ShowInformationResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreInformationController extends Controller{
  public function __invoke(
    StoreInformationRequest $request,
    StoreInformationAction $action,
  ): JsonResponse {
    $information = $action->handle(StoreInformationDTO::fromArray($request->validated()));

    return ShowInformationResource::make($information)
      ->response()
      ->setStatusCode(Response::HTTP_CREATED);
  }
}
