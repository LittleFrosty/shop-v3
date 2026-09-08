<?php

namespace App\Features\Information\Admin\Actions;

use App\Features\Information\Admin\DTOs\DeleteInformationDTO;
use App\Features\Information\Models\Information;

class DeleteInformationAction{
  public function handle(DeleteInformationDTO $dto): void{
    Information::query()->findOrFail($dto->id)->delete();
  }
}
