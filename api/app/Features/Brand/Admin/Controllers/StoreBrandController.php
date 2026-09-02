<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\StoreBrandAction;
use App\Features\Brand\Admin\DTOs\StoreBrandDTO;
use App\Features\Brand\Admin\Requests\StoreBrandRequest;
use App\Http\Controllers\Controller;

class StoreBrandController extends Controller{
  public function __invoke(StoreBrandRequest $request,StoreBrandAction $action) {
    $dto = StoreBrandDTO::fromArray($request->validated());
    $resrouce = new StoreBrandResource($action->handle($dto));
    return $resource;
  }
}