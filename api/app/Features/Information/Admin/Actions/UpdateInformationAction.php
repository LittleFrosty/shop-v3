<?php

namespace App\Features\Information\Admin\Actions;

use App\Features\Information\Admin\DTOs\UpdateInformationDTO;
use App\Features\Information\Models\Information;

class UpdateInformationAction{
  public function handle(UpdateInformationDTO $dto): Information{
    $information = Information::query()->findOrFail($dto->id);
    $information->update($dto->changes());

    return $information->refresh();
  }
}
