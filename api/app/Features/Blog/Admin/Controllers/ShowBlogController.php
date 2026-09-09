<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\ShowBlogAction;
use App\Features\Blog\Admin\Requests\ShowBlogRequest;

use App\Http\Controllers\Controller;

class ShowBlogController extends Controller{
  public function __invoke(ShowBlogRequest $request,ShowBlogAction $action) {
    
  }
}
