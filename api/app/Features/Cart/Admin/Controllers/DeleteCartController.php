<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\DeleteCartAction;
use App\Features\Cart\Admin\DTOs\DeleteCartDTO;
use App\Features\Cart\Admin\Requests\DeleteCartRequest;
use App\Http\Controllers\Controller;

class DeleteCartController extends Controller{
  public function __invoke(DeleteCartRequest $request,DeleteCartAction $action) {
    $dto = DeleteCartDTO::fromArray($request->validated());
    $resrouce = new DeleteCartResource($action->handle($dto));
    return $resource;
  }
}