<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\ShowBlogAction;
use App\Features\Blog\Admin\DTOs\ShowBlogDTO;
use App\Features\Blog\Admin\Requests\ShowBlogRequest;
use App\Http\Controllers\Controller;

class ShowBlogController extends Controller{
  public function __invoke(ShowBlogRequest $request,ShowBlogAction $action) {
    $dto = ShowBlogDTO::fromArray($request->validated());
    $resrouce = new ShowBlogResource($action->handle($dto));
    return $resource;
  }
}