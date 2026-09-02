<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\DeleteBlogAction;
use App\Features\Blog\Admin\DTOs\DeleteBlogDTO;
use App\Features\Blog\Admin\Requests\DeleteBlogRequest;
use App\Http\Controllers\Controller;

class DeleteBlogController extends Controller{
  public function __invoke(DeleteBlogRequest $request,DeleteBlogAction $action) {
    $dto = DeleteBlogDTO::fromArray($request->validated());
    $resrouce = new DeleteBlogResource($action->handle($dto));
    return $resource;
  }
}