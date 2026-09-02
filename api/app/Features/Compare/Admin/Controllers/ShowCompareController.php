<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\ShowCompareAction;
use App\Features\Compare\Admin\DTOs\ShowCompareDTO;
use App\Features\Compare\Admin\Requests\ShowCompareRequest;
use App\Http\Controllers\Controller;

class ShowCompareController extends Controller{
  public function __invoke(ShowCompareRequest $request,ShowCompareAction $action) {
    $dto = ShowCompareDTO::fromArray($request->validated());
    $resrouce = new ShowCompareResource($action->handle($dto));
    return $resource;
  }
}