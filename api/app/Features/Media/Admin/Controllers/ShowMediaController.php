<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\ShowMediaAction;
use App\Features\Media\Admin\DTOs\ShowMediaDTO;
use App\Features\Media\Admin\Requests\ShowMediaRequest;
use App\Http\Controllers\Controller;

class ShowMediaController extends Controller{
  public function __invoke(ShowMediaRequest $request,ShowMediaAction $action) {
    $dto = ShowMediaDTO::fromArray($request->validated());
    $resrouce = new ShowMediaResource($action->handle($dto));
    return $resource;
  }
}