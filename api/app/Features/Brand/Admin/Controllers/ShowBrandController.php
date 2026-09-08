<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\ShowBrandAction;
use App\Features\Brand\Admin\DTOs\ShowBrandDTO;
use App\Features\Brand\Admin\Requests\ShowBrandRequest;
use App\Features\Brand\Admin\Resources\ShowBrandResource;
use App\Http\Controllers\Controller;

class ShowBrandController extends Controller{
  public function __invoke(
    ShowBrandRequest $request,
    ShowBrandAction $action,
  ): ShowBrandResource {
    $brand = $action->handle(ShowBrandDTO::fromArray($request->validated()));

    return new ShowBrandResource($brand);
  }
}
