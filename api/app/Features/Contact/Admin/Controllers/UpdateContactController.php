<?php

namespace App\Features\Contact\Admin\Controllers;

use App\Features\Contact\Admin\Actions\UpdateContactAction;
use App\Features\Contact\Admin\DTOs\UpdateContactDTO;
use App\Features\Contact\Admin\Requests\UpdateContactRequest;
use App\Http\Controllers\Controller;

class UpdateContactController extends Controller{
  public function __invoke(UpdateContactRequest $request,UpdateContactAction $action) {
    $dto = UpdateContactDTO::fromArray($request->validated());
    $resrouce = new UpdateContactResource($action->handle($dto));
    return $resource;
  }
}