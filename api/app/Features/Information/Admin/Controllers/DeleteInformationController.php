<?php

namespace App\Features\Information\Admin\Controllers;

use App\Features\Information\Admin\Actions\DeleteInformationAction;
use App\Features\Information\Admin\DTOs\DeleteInformationDTO;
use App\Features\Information\Admin\Requests\DeleteInformationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteInformationController extends Controller{
  public function __invoke(
    DeleteInformationRequest $request,
    DeleteInformationAction $action,
  ): Response {
    $action->handle(DeleteInformationDTO::fromArray($request->validated()));

    return response()->noContent();
  }
}
