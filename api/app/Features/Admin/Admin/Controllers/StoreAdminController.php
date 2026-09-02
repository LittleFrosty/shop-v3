<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\StoreAdminAction;
use App\Features\Admin\Admin\DTOs\StoreAdminDTO;
use App\Features\Admin\Admin\Requests\StoreAdminRequest;
use App\Http\Controllers\Controller;

class StoreAdminController extends Controller{
  public function __invoke(StoreAdminRequest $request,StoreAdminAction $action) {
    $dto = StoreAdminDTO::fromArray($request->validated());
    $resrouce = new StoreAdminResource($action->handle($dto));
    return $resource;
  }
}