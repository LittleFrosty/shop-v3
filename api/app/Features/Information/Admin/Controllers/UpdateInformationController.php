<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\UpdateInformationAction;
use App\Features\Information\Admin\DTOs\UpdateInformationDTO;
use App\Features\Information\Admin\Requests\UpdateInformationRequest;
use App\Features\Information\Admin\Resources\ShowInformationResource;
use App\Http\Controllers\Controller;

class UpdateInformationController extends Controller{
  public function __invoke(
    UpdateInformationRequest $request,
    UpdateInformationAction $action,
  ): ShowInformationResource {
    $information = $action->handle(UpdateInformationDTO::fromArray($request->validated()));

    return new ShowInformationResource($information);
  }
}
