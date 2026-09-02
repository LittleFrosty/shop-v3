<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\UpdateMediaAction;
use App\Features\Media\Admin\DTOs\UpdateMediaDTO;
use App\Features\Media\Admin\Requests\UpdateMediaRequest;
use App\Http\Controllers\Controller;

class UpdateMediaController extends Controller{
  public function __invoke(UpdateMediaRequest $request,UpdateMediaAction $action) {
    $dto = UpdateMediaDTO::fromArray($request->validated());
    $resrouce = new UpdateMediaResource($action->handle($dto));
    return $resource;
  }
}