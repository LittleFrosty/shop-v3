<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\UpdateBrandAction;
use App\Features\Brand\Admin\DTOs\UpdateBrandDTO;
use App\Features\Brand\Admin\Requests\UpdateBrandRequest;
use App\Features\Brand\Admin\Resources\ShowBrandResource;
use App\Http\Controllers\Controller;

class UpdateBrandController extends Controller{
  public function __invoke(
    UpdateBrandRequest $request,
    UpdateBrandAction $action,
  ): ShowBrandResource {
    $brand = $action->handle(UpdateBrandDTO::fromArray($request->validated()));

    return new ShowBrandResource($brand);
  }
}
