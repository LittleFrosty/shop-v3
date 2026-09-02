<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\ListBlogAction;
use App\Features\Blog\Admin\DTOs\ListBlogDTO;
use App\Features\Blog\Admin\Requests\ListBlogRequest;
use App\Http\Controllers\Controller;

class ListBlogController extends Controller{
  public function __invoke(ListBlogRequest $request,ListBlogAction $action) {
    $dto = ListBlogDTO::fromArray($request->validated());
    $resrouce = new ListBlogResource($action->handle($dto));
    return $resource;
  }
}