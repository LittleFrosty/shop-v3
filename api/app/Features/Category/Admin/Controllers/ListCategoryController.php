<?php

namespace App\Features\Category\Admin\Controllers;

use App\Features\Category\Admin\Actions\ListCategoryAction;
use App\Features\Category\Admin\Requests\ListCategoryRequest;

use App\Http\Controllers\Controller;

class ListCategoryController extends Controller{
  public function __invoke(ListCategoryRequest $request,ListCategoryAction $action) {
    
  }
}
