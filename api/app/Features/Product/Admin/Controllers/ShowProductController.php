<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\ShowProductAction;
use App\Features\Product\Admin\DTOs\ShowProductDTO;
use App\Features\Product\Admin\Requests\ShowProductRequest;
use App\Features\Product\Admin\Resources\ShowProductResource;
use App\Http\Controllers\Controller;

class ShowProductController extends Controller{
  public function __invoke(ShowProductRequest $request,ShowProductAction $action) {
    $dto = ShowProductDTO::fromArray($request->validated());
    $resource = new ShowProductResource($action->handle($dto));
    return $resource;
  }
}
