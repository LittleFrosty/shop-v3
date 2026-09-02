<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\ResourceAdminAction;
use App\Features\Admin\Admin\DTOs\ResourceAdminDTO;
use App\Features\Admin\Admin\Requests\ResourceAdminRequest;
use App\Http\Controllers\Controller;

class ResourceAdminController extends Controller{
  public function __invoke(ResourceAdminRequest $request,ResourceAdminAction $action) {
    $dto = ResourceAdminDTO::fromArray($request->validated());
    $resrouce = new ResourceAdminResource($action->handle($dto));
    return $resource;
  }
}