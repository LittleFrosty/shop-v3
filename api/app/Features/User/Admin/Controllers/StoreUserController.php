<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\StoreUserAction;
use App\Features\User\Admin\Requests\StoreUserRequest;

use App\Http\Controllers\Controller;

class StoreUserController extends Controller{
  public function __invoke(StoreUserRequest $request,StoreUserAction $action) {
    
  }
}
