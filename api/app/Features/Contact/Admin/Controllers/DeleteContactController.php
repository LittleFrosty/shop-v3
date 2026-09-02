<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\DeleteContactAction;
use App\Features\Contact\Admin\DTOs\DeleteContactDTO;
use App\Features\Contact\Admin\Requests\DeleteContactRequest;
use App\Http\Controllers\Controller;

class DeleteContactController extends Controller{
  public function __invoke(DeleteContactRequest $request,DeleteContactAction $action) {
    $dto = DeleteContactDTO::fromArray($request->validated());
    $resrouce = new DeleteContactResource($action->handle($dto));
    return $resource;
  }
}