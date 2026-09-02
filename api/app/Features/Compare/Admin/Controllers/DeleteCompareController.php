<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\DeleteCompareAction;
use App\Features\Compare\Admin\DTOs\DeleteCompareDTO;
use App\Features\Compare\Admin\Requests\DeleteCompareRequest;
use App\Http\Controllers\Controller;

class DeleteCompareController extends Controller{
  public function __invoke(DeleteCompareRequest $request,DeleteCompareAction $action) {
    $dto = DeleteCompareDTO::fromArray($request->validated());
    $resrouce = new DeleteCompareResource($action->handle($dto));
    return $resource;
  }
}