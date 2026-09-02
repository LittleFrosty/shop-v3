<?php

use App\Features\Admin\Admin\Controllers\DeleteAdminController;
use App\Features\Admin\Admin\Controllers\ListAdminController;
use App\Features\Admin\Admin\Controllers\ShowAdminController;
use App\Features\Admin\Admin\Controllers\StoreAdminController;
use App\Features\Admin\Admin\Controllers\UpdateAdminController;
use App\Features\Brand\Admin\Controllers\DeleteBrandController;
use App\Features\Brand\Admin\Controllers\ListBrandController;
use App\Features\Brand\Admin\Controllers\ShowBrandController;
use App\Features\Brand\Admin\Controllers\StoreBrandController;
use App\Features\Brand\Admin\Controllers\UpdateBrandController;
use App\Features\Category\Admin\Controllers\DeleteCategoryController;
use App\Features\Category\Admin\Controllers\ListCategoryController;
use App\Features\Category\Admin\Controllers\ShowCategoryController;
use App\Features\Category\Admin\Controllers\StoreCategoryController;
use App\Features\Category\Admin\Controllers\UpdateCategoryController;
use App\Features\Information\Admin\Controllers\DeleteInformationController;
use App\Features\Information\Admin\Controllers\ListInformationController;
use App\Features\Information\Admin\Controllers\ShowInformationController;
use App\Features\Information\Admin\Controllers\StoreInformationController;
use App\Features\Information\Admin\Controllers\UpdateInformationController;
use App\Features\Product\Admin\Controllers\DeleteProductController;
use App\Features\Product\Admin\Controllers\ListProductController;
use App\Features\Product\Admin\Controllers\ShowProductController;
use App\Features\Product\Admin\Controllers\StoreProductController;
use App\Features\Product\Admin\Controllers\UpdateProductController;
use App\Features\User\Admin\Controllers\DeleteUserController;
use App\Features\User\Admin\Controllers\ListUserController;
use App\Features\User\Admin\Controllers\ShowUserController;
use App\Features\User\Admin\Controllers\StoreUserController;
use App\Features\User\Admin\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    Route::get('/list', ListProductController::class);

    Route::post('/store', StoreProductController::class);

    Route::get('/{id}', ShowProductController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateProductController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteProductController::class)->whereNumber('id');
});

Route::prefix('category')->group(function () {
    Route::get('/list', ListCategoryController::class);

    Route::post('/store', StoreCategoryController::class);

    Route::get('/{id}', ShowCategoryController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateCategoryController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteCategoryController::class)->whereNumber('id');
});

Route::prefix('information')->group(function () {
    Route::get('/list', ListInformationController::class);

    Route::post('/store', StoreInformationController::class);

    Route::get('/{id}', ShowInformationController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateInformationController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteInformationController::class)->whereNumber('id');
});

Route::prefix('brand')->group(function () {
    Route::get('/list', ListBrandController::class);

    Route::post('/store', StoreBrandController::class);

    Route::get('/{id}', ShowBrandController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateBrandController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteBrandController::class)->whereNumber('id');
});

Route::prefix('user')->group(function () {
    Route::get('/list', ListUserController::class);

    Route::post('/store', StoreUserController::class);

    Route::get('/{id}', ShowUserController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateUserController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteUserController::class)->whereNumber('id');
});

Route::prefix('admin')->group(function () {
    Route::get('/list', ListAdminController::class);

    Route::post('/store', StoreAdminController::class);

    Route::get('/{id}', ShowAdminController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateAdminController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteAdminController::class)->whereNumber('id');
});
