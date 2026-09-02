<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\DeleteInformationAction;
use App\Features\Information\Admin\DTOs\DeleteInformationDTO;
use App\Features\Information\Admin\Requests\DeleteInformationRequest;
use App\Http\Controllers\Controller;

class DeleteInformationController extends Controller{
  public function __invoke(DeleteInformationRequest $request,DeleteInformationAction $action) {
    $dto = DeleteInformationDTO::fromArray($request->validated());
    $resrouce = new DeleteInformationResource($action->handle($dto));
    return $resource;
  }
}