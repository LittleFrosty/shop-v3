<?php

namespace App\Features\Compare\Admin\Controllers;

use App\Features\Compare\Admin\Actions\ResourceCompareAction;
use App\Features\Compare\Admin\DTOs\ResourceCompareDTO;
use App\Features\Compare\Admin\Requests\ResourceCompareRequest;
use App\Http\Controllers\Controller;

class ResourceCompareController extends Controller{
  public function __invoke(ResourceCompareRequest $request,ResourceCompareAction $action) {
    $dto = ResourceCompareDTO::fromArray($request->validated());
    $resrouce = new ResourceCompareResource($action->handle($dto));
    return $resource;
  }
}