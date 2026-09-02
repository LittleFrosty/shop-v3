<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\UpdateInformationAction;
use App\Features\Information\Admin\DTOs\UpdateInformationDTO;
use App\Features\Information\Admin\Requests\UpdateInformationRequest;
use App\Http\Controllers\Controller;

class UpdateInformationController extends Controller{
  public function __invoke(UpdateInformationRequest $request,UpdateInformationAction $action) {
    $dto = UpdateInformationDTO::fromArray($request->validated());
    $resrouce = new UpdateInformationResource($action->handle($dto));
    return $resource;
  }
}