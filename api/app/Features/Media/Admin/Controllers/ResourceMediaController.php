<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\ResourceMediaAction;
use App\Features\Media\Admin\DTOs\ResourceMediaDTO;
use App\Features\Media\Admin\Requests\ResourceMediaRequest;
use App\Http\Controllers\Controller;

class ResourceMediaController extends Controller{
  public function __invoke(ResourceMediaRequest $request,ResourceMediaAction $action) {
    $dto = ResourceMediaDTO::fromArray($request->validated());
    $resrouce = new ResourceMediaResource($action->handle($dto));
    return $resource;
  }
}