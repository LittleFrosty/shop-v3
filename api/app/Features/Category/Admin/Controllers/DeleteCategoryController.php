<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\DeleteCategoryAction;
use App\Features\Category\Admin\Requests\DeleteCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteCategoryController extends Controller{
  public function __invoke(DeleteCategoryRequest $request,DeleteCategoryAction $action): Response{
    $action->handle((int)$request->validated('id'));

    return response()->noContent();
  }
}
