<?php

namespace App\Features\Media\Admin\Controllers;

use App\Features\Media\Admin\Actions\StoreMediaAction;
use App\Features\Media\Admin\DTOs\StoreMediaDTO;
use App\Features\Media\Admin\Requests\StoreMediaRequest;
use App\Http\Controllers\Controller;

class StoreMediaController extends Controller{
  public function __invoke(StoreMediaRequest $request,StoreMediaAction $action) {
    $dto = StoreMediaDTO::fromArray($request->validated());
    $resrouce = new StoreMediaResource($action->handle($dto));
    return $resource;
  }
}