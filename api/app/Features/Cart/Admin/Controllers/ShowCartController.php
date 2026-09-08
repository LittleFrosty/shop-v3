<?php

namespace App\Features\Cart\Admin\Controllers;

use App\Features\Cart\Admin\Actions\ShowCartAction;
use App\Features\Cart\Admin\DTOs\ShowCartDTO;
use App\Features\Cart\Admin\Requests\ShowCartRequest;
use App\Features\Cart\Admin\Resources\ShowCartResource;
use App\Http\Controllers\Controller;

class ShowCartController extends Controller{
  public function __invoke(ShowCartRequest $request, ShowCartAction $action): ShowCartResource{
    return new ShowCartResource(
      $action->handle(ShowCartDTO::fromArray($request->validated()))
    );
  }
}
