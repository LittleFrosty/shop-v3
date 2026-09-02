<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\ShowInformationAction;
use App\Features\Information\Admin\DTOs\ShowInformationDTO;
use App\Features\Information\Admin\Requests\ShowInformationRequest;
use App\Http\Controllers\Controller;

class ShowInformationController extends Controller{
  public function __invoke(ShowInformationRequest $request,ShowInformationAction $action) {
    $dto = ShowInformationDTO::fromArray($request->validated());
    $resrouce = new ShowInformationResource($action->handle($dto));
    return $resource;
  }
}