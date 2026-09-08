<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\StoreProductAction;
use App\Features\Product\Admin\DTOs\StoreProductDTO;
use App\Features\Product\Admin\Requests\StoreProductRequest;
use App\Features\Product\Admin\Resources\StoreProductResource;
use App\Http\Controllers\Controller;

class StoreProductController extends Controller{
  public function __invoke(
    StoreProductRequest $request,
    StoreProductAction $action
  ){
    $dto = StoreProductDTO::fromArray(
      $request->validated()
    );

    return (new StoreProductResource($action->handle($dto)))
      ->response()
      ->setStatusCode(201);
  }
}
