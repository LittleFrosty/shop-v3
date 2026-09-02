<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\ResourceCategoryAction;
use App\Features\Category\Admin\DTOs\ResourceCategoryDTO;
use App\Features\Category\Admin\Requests\ResourceCategoryRequest;
use App\Http\Controllers\Controller;

class ResourceCategoryController extends Controller{
  public function __invoke(ResourceCategoryRequest $request,ResourceCategoryAction $action) {
    $dto = ResourceCategoryDTO::fromArray($request->validated());
    $resrouce = new ResourceCategoryResource($action->handle($dto));
    return $resource;
  }
}