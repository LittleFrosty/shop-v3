<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\StoreContactAction;
use App\Features\Contact\Admin\DTOs\StoreContactDTO;
use App\Features\Contact\Admin\Requests\StoreContactRequest;
use App\Http\Controllers\Controller;

class StoreContactController extends Controller{
  public function __invoke(StoreContactRequest $request,StoreContactAction $action) {
    $dto = StoreContactDTO::fromArray($request->validated());
    $resrouce = new StoreContactResource($action->handle($dto));
    return $resource;
  }
}