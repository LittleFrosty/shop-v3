<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\ShowInformationAction;
use App\Features\Information\Admin\DTOs\ShowInformationDTO;
use App\Features\Information\Admin\Requests\ShowInformationRequest;
use App\Features\Information\Admin\Resources\ShowInformationResource;
use App\Http\Controllers\Controller;

class ShowInformationController extends Controller{
  public function __invoke(
    ShowInformationRequest $request,
    ShowInformationAction $action,
  ): ShowInformationResource {
    $information = $action->handle(ShowInformationDTO::fromArray($request->validated()));

    return new ShowInformationResource($information);
  }
}
