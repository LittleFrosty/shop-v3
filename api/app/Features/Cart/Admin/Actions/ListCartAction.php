<?php

namespace App\Features\Cart\Admin\Actions;

use App\Features\Cart\Admin\DTOs\ListCartDTO;
use App\Features\Cart\Admin\Queries\ListCartQuery;
use Illuminate\Pagination\LengthAwarePaginator;

class ListCartAction{
  public function __construct(private ListCartQuery $query){}

  public function handle(ListCartDTO $dto): LengthAwarePaginator{
    return $this->query->handle($dto);
  }
}
