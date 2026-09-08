<?php

namespace App\Features\Brand\Admin\Actions;

use App\Features\Brand\Admin\DTOs\ShowBrandDTO;
use App\Features\Brand\Admin\Queries\ShowBrandQuery;
use App\Features\Brand\Models\Brand;

class ShowBrandAction{
  public function __construct(private readonly ShowBrandQuery $query){}

  public function handle(ShowBrandDTO $dto): Brand{
    return $this->query->handle($dto);
  }
}
