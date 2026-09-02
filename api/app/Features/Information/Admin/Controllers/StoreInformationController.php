<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\StoreInformationAction;
use App\Features\Information\Admin\DTOs\StoreInformationDTO;
use App\Features\Information\Admin\Requests\StoreInformationRequest;
use App\Http\Controllers\Controller;

class StoreInformationController extends Controller{
  public function __invoke(StoreInformationRequest $request,StoreInformationAction $action) {
    $dto = StoreInformationDTO::fromArray($request->validated());
    $resrouce = new StoreInformationResource($action->handle($dto));
    return $resource;
  }
}