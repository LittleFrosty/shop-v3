<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\DeleteMediaAction;
use App\Features\Media\Admin\DTOs\DeleteMediaDTO;
use App\Features\Media\Admin\Requests\DeleteMediaRequest;
use App\Http\Controllers\Controller;

class DeleteMediaController extends Controller{
  public function __invoke(DeleteMediaRequest $request,DeleteMediaAction $action) {
    $dto = DeleteMediaDTO::fromArray($request->validated());
    $resrouce = new DeleteMediaResource($action->handle($dto));
    return $resource;
  }
}