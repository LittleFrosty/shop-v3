<?php

namespace App\Features\Contact\Admin\Queries;

use App\Features\Contact\Admin\DTOs\ListContactDTO;
use App\Features\Contact\Models\Contact;

class ListContactQuery{
  public function handle(ListContactDTO $dto): mixed{
    return Contact::query()->get();
  }
}
