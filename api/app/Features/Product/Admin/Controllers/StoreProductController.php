<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\StoreProductAction;
use App\Features\Product\Admin\DTOs\StoreProductDTO;
use App\Features\Product\Admin\Requests\StoreProductRequest;
use App\Http\Controllers\Controller;

class StoreProductController extends Controller
{
    public function __invoke(
        StoreProductRequest $request,
        StoreProductAction $action
    ) {
        $dto = StoreProductDTO::fromArray(
            $request->validated()
        );

        return $action->handle($dto);
    }
}