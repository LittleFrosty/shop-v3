<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\ResourceBlogAction;
use App\Features\Blog\Admin\DTOs\ResourceBlogDTO;
use App\Features\Blog\Admin\Requests\ResourceBlogRequest;
use App\Http\Controllers\Controller;

class ResourceBlogController extends Controller{
  public function __invoke(ResourceBlogRequest $request,ResourceBlogAction $action) {
    $dto = ResourceBlogDTO::fromArray($request->validated());
    $resrouce = new ResourceBlogResource($action->handle($dto));
    return $resource;
  }
}