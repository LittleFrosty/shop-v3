<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\ListCompareAction;
use App\Features\Compare\Admin\DTOs\ListCompareDTO;
use App\Features\Compare\Admin\Requests\ListCompareRequest;
use App\Http\Controllers\Controller;

class ListCompareController extends Controller{
  public function __invoke(ListCompareRequest $request,ListCompareAction $action) {
    $dto = ListCompareDTO::fromArray($request->validated());
    $resrouce = new ListCompareResource($action->handle($dto));
    return $resource;
  }
}