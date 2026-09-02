<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\StoreCompareAction;
use App\Features\Compare\Admin\DTOs\StoreCompareDTO;
use App\Features\Compare\Admin\Requests\StoreCompareRequest;
use App\Http\Controllers\Controller;

class StoreCompareController extends Controller{
  public function __invoke(StoreCompareRequest $request,StoreCompareAction $action) {
    $dto = StoreCompareDTO::fromArray($request->validated());
    $resrouce = new StoreCompareResource($action->handle($dto));
    return $resource;
  }
}