<?php

namespace App\Features\Information\Admin\Actions;

use App\Features\Information\Admin\DTOs\ShowInformationDTO;
use App\Features\Information\Admin\Queries\ShowInformationQuery;
use App\Features\Information\Models\Information;

class ShowInformationAction{
  public function __construct(private readonly ShowInformationQuery $query){}

  public function handle(ShowInformationDTO $dto): Information{
    return $this->query->handle($dto);
  }
}
