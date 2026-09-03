<?php

namespace App\Features\Brand\Admin\Controllers;

use App\Features\Brand\Admin\Actions\DeleteBrandAction;
use App\Features\Brand\Admin\Requests\DeleteBrandRequest;

use App\Http\Controllers\Controller;

class DeleteBrandController extends Controller{
  public function __invoke(DeleteBrandRequest $request,DeleteBrandAction $action) {
    
  }
}
