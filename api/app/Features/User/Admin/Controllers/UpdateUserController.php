<?php

namespace App\Features\User\Admin\Controllers;

use App\Features\User\Admin\Actions\UpdateUserAction;
use App\Features\User\Admin\Requests\UpdateUserRequest;

use App\Http\Controllers\Controller;

class UpdateUserController extends Controller{
  public function __invoke(UpdateUserRequest $request,UpdateUserAction $action) {
    
  }
}
