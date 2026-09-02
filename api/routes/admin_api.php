<?php

use Illuminate\Support\Facades\Route;

use App\Features\Product\Admin\Controllers\ShowProductController;

Route::prefix('product')->group(function () {
  Route::get('/{id}', ShowProductController::class)->whereNumber('id');
});