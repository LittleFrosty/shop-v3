<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\ShowCategoryAction;
use App\Features\Category\Admin\DTOs\ShowCategoryDTO;
use App\Features\Category\Admin\Requests\ShowCategoryRequest;
use App\Http\Controllers\Controller;

class ShowCategoryController extends Controller{
  public function __invoke(ShowCategoryRequest $request,ShowCategoryAction $action) {
    $dto = ShowCategoryDTO::fromArray($request->validated());
    $resrouce = new ShowCategoryResource($action->handle($dto));
    return $resource;
  }
}