<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\DeleteProductAction;
use App\Features\Product\Admin\DTOs\DeleteProductDTO;
use App\Features\Product\Admin\Requests\DeleteProductRequest;
use App\Http\Controllers\Controller;

class DeleteProductController extends Controller
{
    public function __invoke(
        DeleteProductRequest $request,
        DeleteProductAction $action
    ) {
        $dto = DeleteProductDTO::fromArray(
            $request->validated()
        );

        return $action->handle($dto);
    }
}