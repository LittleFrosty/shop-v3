<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\UpdateCartAction;
use App\Features\Cart\Admin\DTOs\UpdateCartDTO;
use App\Features\Cart\Admin\Requests\UpdateCartRequest;
use App\Features\Cart\Admin\Resources\UpdateCartResource;
use App\Http\Controllers\Controller;

class UpdateCartController extends Controller{
  public function __invoke(UpdateCartRequest $request, UpdateCartAction $action): UpdateCartResource{
    return new UpdateCartResource(
      $action->handle(UpdateCartDTO::fromArray($request->validated()))
    );
  }
}
