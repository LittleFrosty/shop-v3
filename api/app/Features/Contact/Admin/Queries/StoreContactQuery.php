<?php

namespace App\Features\Contact\Admin\Queries;

use App\Features\Contact\Admin\DTOs\StoreContactDTO;
use App\Features\Contact\Models\Contact;

class StoreContactQuery{
  public function handle(StoreContactDTO $dto): mixed{
    return Contact::query()->get();
  }
}
