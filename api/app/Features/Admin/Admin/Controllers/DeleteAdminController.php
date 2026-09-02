<?php

namespace App\Features\Admin\Admin\Controllers;

use App\Features\Admin\Admin\Actions\DeleteAdminAction;
use App\Features\Admin\Admin\DTOs\DeleteAdminDTO;
use App\Features\Admin\Admin\Requests\DeleteAdminRequest;
use App\Http\Controllers\Controller;

class DeleteAdminController extends Controller{
  public function __invoke(DeleteAdminRequest $request,DeleteAdminAction $action) {
    $dto = DeleteAdminDTO::fromArray($request->validated());
    $resrouce = new DeleteAdminResource($action->handle($dto));
    return $resource;
  }
}