<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\StoreBrandAction;
use App\Features\Brand\Admin\Requests\StoreBrandRequest;

use App\Http\Controllers\Controller;

class StoreBrandController extends Controller{
  public function __invoke(StoreBrandRequest $request,StoreBrandAction $action) {
    
  }
}
