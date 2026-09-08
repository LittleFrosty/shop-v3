<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\UpdateCategoryAction;
use App\Features\Category\Admin\DTOs\UpdateCategoryDTO;
use App\Features\Category\Admin\Requests\UpdateCategoryRequest;
use App\Features\Category\Admin\Resources\ShowCategoryResource;
use App\Http\Controllers\Controller;

class UpdateCategoryController extends Controller{
  public function __invoke(UpdateCategoryRequest $request,UpdateCategoryAction $action) {
    $dto = UpdateCategoryDTO::fromArray($request->validated());

    return ShowCategoryResource::make($action->handle($dto));
  }
}
