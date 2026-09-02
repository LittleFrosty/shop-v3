<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\StoreCategoryAction;
use App\Features\Category\Admin\DTOs\StoreCategoryDTO;
use App\Features\Category\Admin\Requests\StoreCategoryRequest;
use App\Http\Controllers\Controller;

class StoreCategoryController extends Controller{
  public function __invoke(StoreCategoryRequest $request,StoreCategoryAction $action) {
    $dto = StoreCategoryDTO::fromArray($request->validated());
    $resrouce = new StoreCategoryResource($action->handle($dto));
    return $resource;
  }
}