<?php

namespace App\Features\Product\Admin\Controllers;

use App\Features\Product\Admin\Actions\ListProductAction;
use App\Features\Product\Admin\DTOs\ListProductDTO;
use App\Features\Product\Admin\Requests\ListProductRequest;
use App\Http\Controllers\Controller;

class ListProductController extends Controller
{
    public function __invoke(
        ListProductRequest $request,
        ListProductAction $action
    ) {
        $dto = ListProductDTO::fromArray(
            $request->validated()
        );

        return $action->handle($dto);
    }
}
