<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\ListContactAction;
use App\Features\Contact\Admin\DTOs\ListContactDTO;
use App\Features\Contact\Admin\Requests\ListContactRequest;
use App\Http\Controllers\Controller;

class ListContactController extends Controller{
  public function __invoke(ListContactRequest $request,ListContactAction $action) {
    $dto = ListContactDTO::fromArray($request->validated());
    $resrouce = new ListContactResource($action->handle($dto));
    return $resource;
  }
}