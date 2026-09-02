<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\UpdateCompareAction;
use App\Features\Compare\Admin\DTOs\UpdateCompareDTO;
use App\Features\Compare\Admin\Requests\UpdateCompareRequest;
use App\Http\Controllers\Controller;

class UpdateCompareController extends Controller{
  public function __invoke(UpdateCompareRequest $request,UpdateCompareAction $action) {
    $dto = UpdateCompareDTO::fromArray($request->validated());
    $resrouce = new UpdateCompareResource($action->handle($dto));
    return $resource;
  }
}