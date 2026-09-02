<?php

namespace App\Features\Contact\Admin\Queries;

use App\Features\Contact\Admin\DTOs\ShowContactDTO;
use App\Features\Contact\Models\Contact;

class ShowContactQuery{
  public function handle(ShowContactDTO $dto): mixed{
    return Contact::query()->get();
  }
}
