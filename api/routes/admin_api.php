<?php

use App\Features\Product\Admin\Controllers\DeleteProductController;
use App\Features\Product\Admin\Controllers\ListProductController;
use App\Features\Product\Admin\Controllers\ShowProductController;
use App\Features\Product\Admin\Controllers\StoreProductController;
use App\Features\Product\Admin\Controllers\UpdateProductController;
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

Route::prefix('brand')->group(function () {
    Route::get('/list', ListBrandController::class);

    Route::post('/store', StoreBrandController::class);

    Route::get('/{id}', ShowBrandController::class)->whereNumber('id');

    Route::patch('/{id}/update', UpdateBrandController::class)->whereNumber('id');

    Route::delete('/{id}/delete', DeleteBrandController::class)->whereNumber('id');
});

