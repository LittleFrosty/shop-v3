<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\ListBrandAction;
use App\Features\Brand\Admin\DTOs\ListBrandDTO;
use App\Features\Brand\Admin\Requests\ListBrandRequest;
use App\Http\Controllers\Controller;

class ListBrandController extends Controller{
  public function __invoke(ListBrandRequest $request,ListBrandAction $action) {
    $dto = ListBrandDTO::fromArray($request->validated());
    $resrouce = new ListBrandResource($action->handle($dto));
    return $resource;
  }
}