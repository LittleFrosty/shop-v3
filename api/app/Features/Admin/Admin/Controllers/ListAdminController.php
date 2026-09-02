<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\ListAdminAction;
use App\Features\Admin\Admin\DTOs\ListAdminDTO;
use App\Features\Admin\Admin\Requests\ListAdminRequest;
use App\Http\Controllers\Controller;

class ListAdminController extends Controller{
  public function __invoke(ListAdminRequest $request,ListAdminAction $action) {
    $dto = ListAdminDTO::fromArray($request->validated());
    $resrouce = new ListAdminResource($action->handle($dto));
    return $resource;
  }
}