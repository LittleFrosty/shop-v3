<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\ListInformationAction;
use App\Features\Information\Admin\DTOs\ListInformationDTO;
use App\Features\Information\Admin\Requests\ListInformationRequest;
use App\Http\Controllers\Controller;

class ListInformationController extends Controller{
  public function __invoke(ListInformationRequest $request,ListInformationAction $action) {
    $dto = ListInformationDTO::fromArray($request->validated());
    $resrouce = new ListInformationResource($action->handle($dto));
    return $resource;
  }
}