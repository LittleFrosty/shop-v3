<?php

namespace App\Features\Contact\Admin\Queries;

use App\Features\Contact\Admin\DTOs\ResourceContactDTO;
use App\Features\Contact\Models\Contact;

class ResourceContactQuery{
  public function handle(ResourceContactDTO $dto): mixed{
    return Contact::query()->get();
  }
}
