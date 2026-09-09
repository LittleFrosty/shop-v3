<?php

namespace App\Features\Blog\Admin\Controllers;

use App\Features\Blog\Admin\Actions\StoreBlogAction;
use App\Features\Blog\Admin\Requests\StoreBlogRequest;

use App\Http\Controllers\Controller;

class StoreBlogController extends Controller{
  public function __invoke(StoreBlogRequest $request,StoreBlogAction $action) {
    
  }
}
