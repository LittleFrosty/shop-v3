<?php

namespace App\Features\Cart\Admin\Actions;

use App\Features\Cart\Admin\DTOs\ShowCartDTO;
use App\Features\Cart\Admin\Queries\ShowCartQuery;
use App\Features\Cart\Models\Cart;

class ShowCartAction{
  public function __construct(private ShowCartQuery $query){}

  public function handle(ShowCartDTO $dto): Cart{
    return $this->query->handle($dto);
  }
}
