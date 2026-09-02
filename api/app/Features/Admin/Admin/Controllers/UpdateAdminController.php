<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\UpdateAdminAction;
use App\Features\Admin\Admin\DTOs\UpdateAdminDTO;
use App\Features\Admin\Admin\Requests\UpdateAdminRequest;
use App\Http\Controllers\Controller;

class UpdateAdminController extends Controller{
  public function __invoke(UpdateAdminRequest $request,UpdateAdminAction $action) {
    $dto = UpdateAdminDTO::fromArray($request->validated());
    $resrouce = new UpdateAdminResource($action->handle($dto));
    return $resource;
  }
}