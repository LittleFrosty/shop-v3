<?php

namespace App\Features\Information\Admin\Queries;

use App\Features\Information\Admin\DTOs\ListInformationDTO;
use App\Features\Information\Models\Information;
use Illuminate\Pagination\LengthAwarePaginator;

class ListInformationQuery{
  public function handle(ListInformationDTO $dto): LengthAwarePaginator{
    $information = Information::query();

    if ($dto->title !== null) {
      $information->where('title', 'like', '%'.$dto->title.'%');
    }

    if ($dto->status !== null) {
      $information->where('status', $dto->status);
    }

    return $information
      ->orderBy('sort_order')
      ->orderBy('id')
      ->paginate(50);
  }
}
