<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\ShowAdminAction;
use App\Features\Admin\Admin\DTOs\ShowAdminDTO;
use App\Features\Admin\Admin\Requests\ShowAdminRequest;
use App\Http\Controllers\Controller;

class ShowAdminController extends Controller{
  public function __invoke(ShowAdminRequest $request,ShowAdminAction $action) {
    $dto = ShowAdminDTO::fromArray($request->validated());
    $resrouce = new ShowAdminResource($action->handle($dto));
    return $resource;
  }
}