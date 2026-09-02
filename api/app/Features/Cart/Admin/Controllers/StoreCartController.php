<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\StoreCartAction;
use App\Features\Cart\Admin\DTOs\StoreCartDTO;
use App\Features\Cart\Admin\Requests\StoreCartRequest;
use App\Http\Controllers\Controller;

class StoreCartController extends Controller{
  public function __invoke(StoreCartRequest $request,StoreCartAction $action) {
    $dto = StoreCartDTO::fromArray($request->validated());
    $resrouce = new StoreCartResource($action->handle($dto));
    return $resource;
  }
}