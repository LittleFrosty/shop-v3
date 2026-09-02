<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\ListMediaAction;
use App\Features\Media\Admin\DTOs\ListMediaDTO;
use App\Features\Media\Admin\Requests\ListMediaRequest;
use App\Http\Controllers\Controller;

class ListMediaController extends Controller{
  public function __invoke(ListMediaRequest $request,ListMediaAction $action) {
    $dto = ListMediaDTO::fromArray($request->validated());
    $resrouce = new ListMediaResource($action->handle($dto));
    return $resource;
  }
}