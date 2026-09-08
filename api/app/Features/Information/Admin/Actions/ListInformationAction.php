<?php

namespace App\Features\Information\Admin\Actions;

use App\Features\Information\Admin\DTOs\ListInformationDTO;
use App\Features\Information\Admin\Queries\ListInformationQuery;
use Illuminate\Pagination\LengthAwarePaginator;

class ListInformationAction{
  public function __construct(private readonly ListInformationQuery $query){}

  public function handle(ListInformationDTO $dto): LengthAwarePaginator{
    return $this->query->handle($dto);
  }
}
