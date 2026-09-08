<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\StoreCartAction;
use App\Features\Cart\Admin\DTOs\StoreCartDTO;
use App\Features\Cart\Admin\Requests\StoreCartRequest;
use App\Features\Cart\Admin\Resources\StoreCartResource;
use App\Http\Controllers\Controller;

class StoreCartController extends Controller{
  public function __invoke(StoreCartRequest $request, StoreCartAction $action){
    $resource = new StoreCartResource(
      $action->handle(StoreCartDTO::fromArray($request->validated()))
    );

    return $resource->response()->setStatusCode(201);
  }
}
