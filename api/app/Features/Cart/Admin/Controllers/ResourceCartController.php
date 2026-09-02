<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\ResourceCartAction;
use App\Features\Cart\Admin\DTOs\ResourceCartDTO;
use App\Features\Cart\Admin\Requests\ResourceCartRequest;
use App\Http\Controllers\Controller;

class ResourceCartController extends Controller{
  public function __invoke(ResourceCartRequest $request,ResourceCartAction $action) {
    $dto = ResourceCartDTO::fromArray($request->validated());
    $resrouce = new ResourceCartResource($action->handle($dto));
    return $resource;
  }
}