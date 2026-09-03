<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\ListUserAction;
use App\Features\User\Admin\Requests\ListUserRequest;

use App\Http\Controllers\Controller;

class ListUserController extends Controller{
  public function __invoke(ListUserRequest $request,ListUserAction $action) {
    
  }
}
