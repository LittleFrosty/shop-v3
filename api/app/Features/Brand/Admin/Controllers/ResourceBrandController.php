<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\ResourceBrandAction;
use App\Features\Brand\Admin\DTOs\ResourceBrandDTO;
use App\Features\Brand\Admin\Requests\ResourceBrandRequest;
use App\Http\Controllers\Controller;

class ResourceBrandController extends Controller{
  public function __invoke(ResourceBrandRequest $request,ResourceBrandAction $action) {
    $dto = ResourceBrandDTO::fromArray($request->validated());
    $resrouce = new ResourceBrandResource($action->handle($dto));
    return $resource;
  }
}