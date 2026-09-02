<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\ListCartAction;
use App\Features\Cart\Admin\DTOs\ListCartDTO;
use App\Features\Cart\Admin\Requests\ListCartRequest;
use App\Http\Controllers\Controller;

class ListCartController extends Controller{
  public function __invoke(ListCartRequest $request,ListCartAction $action) {
    $dto = ListCartDTO::fromArray($request->validated());
    $resrouce = new ListCartResource($action->handle($dto));
    return $resource;
  }
}