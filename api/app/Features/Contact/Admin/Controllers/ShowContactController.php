<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\ShowContactAction;
use App\Features\Contact\Admin\DTOs\ShowContactDTO;
use App\Features\Contact\Admin\Requests\ShowContactRequest;
use App\Http\Controllers\Controller;

class ShowContactController extends Controller{
  public function __invoke(ShowContactRequest $request,ShowContactAction $action) {
    $dto = ShowContactDTO::fromArray($request->validated());
    $resrouce = new ShowContactResource($action->handle($dto));
    return $resource;
  }
}