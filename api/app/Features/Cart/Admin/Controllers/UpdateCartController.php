<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\UpdateCartAction;
use App\Features\Cart\Admin\DTOs\UpdateCartDTO;
use App\Features\Cart\Admin\Requests\UpdateCartRequest;
use App\Http\Controllers\Controller;

class UpdateCartController extends Controller{
  public function __invoke(UpdateCartRequest $request,UpdateCartAction $action) {
    $dto = UpdateCartDTO::fromArray($request->validated());
    $resrouce = new UpdateCartResource($action->handle($dto));
    return $resource;
  }
}