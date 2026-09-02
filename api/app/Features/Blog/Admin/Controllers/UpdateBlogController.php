<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\UpdateBlogAction;
use App\Features\Blog\Admin\DTOs\UpdateBlogDTO;
use App\Features\Blog\Admin\Requests\UpdateBlogRequest;
use App\Http\Controllers\Controller;

class UpdateBlogController extends Controller{
  public function __invoke(UpdateBlogRequest $request,UpdateBlogAction $action) {
    $dto = UpdateBlogDTO::fromArray($request->validated());
    $resrouce = new UpdateBlogResource($action->handle($dto));
    return $resource;
  }
}