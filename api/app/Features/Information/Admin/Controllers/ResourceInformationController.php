<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\ResourceInformationAction;
use App\Features\Information\Admin\DTOs\ResourceInformationDTO;
use App\Features\Information\Admin\Requests\ResourceInformationRequest;
use App\Http\Controllers\Controller;

class ResourceInformationController extends Controller{
  public function __invoke(ResourceInformationRequest $request,ResourceInformationAction $action) {
    $dto = ResourceInformationDTO::fromArray($request->validated());
    $resrouce = new ResourceInformationResource($action->handle($dto));
    return $resource;
  }
}