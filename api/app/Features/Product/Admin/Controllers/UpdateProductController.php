<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\UpdateProductAction;
use App\Features\Product\Admin\DTOs\UpdateProductDTO;
use App\Features\Product\Admin\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;

class UpdateProductController extends Controller
{
    public function __invoke(
        UpdateProductRequest $request,
        UpdateProductAction $action
    ) {
        $dto = UpdateProductDTO::fromArray(
            $request->validated()
        );

        return $action->handle($dto);
    }
}