<?php

namespace App\Features\Contact\Admin\Queries;

use App\Features\Contact\Admin\DTOs\UpdateContactDTO;
use App\Features\Contact\Models\Contact;

class UpdateContactQuery{
  public function handle(UpdateContactDTO $dto): mixed{
    return Contact::query()->get();
  }
}
