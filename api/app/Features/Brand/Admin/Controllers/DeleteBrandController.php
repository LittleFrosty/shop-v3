<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\DeleteBrandAction;
use App\Features\Brand\Admin\DTOs\DeleteBrandDTO;
use App\Features\Brand\Admin\Requests\DeleteBrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteBrandController extends Controller{
  public function __invoke(
    DeleteBrandRequest $request,
    DeleteBrandAction $action,
  ): Response {
    $action->handle(DeleteBrandDTO::fromArray($request->validated()));

    return response()->noContent();
  }
}
