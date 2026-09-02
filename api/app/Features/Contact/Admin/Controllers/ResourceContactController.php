<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\ResourceContactAction;
use App\Features\Contact\Admin\DTOs\ResourceContactDTO;
use App\Features\Contact\Admin\Requests\ResourceContactRequest;
use App\Http\Controllers\Controller;

class ResourceContactController extends Controller{
  public function __invoke(ResourceContactRequest $request,ResourceContactAction $action) {
    $dto = ResourceContactDTO::fromArray($request->validated());
    $resrouce = new ResourceContactResource($action->handle($dto));
    return $resource;
  }
}