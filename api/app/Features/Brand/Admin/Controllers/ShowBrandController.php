<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\ShowBrandAction;
use App\Features\Brand\Admin\Requests\ShowBrandRequest;

use App\Http\Controllers\Controller;

class ShowBrandController extends Controller{
  public function __invoke(ShowBrandRequest $request,ShowBrandAction $action) {
    
  }
}
