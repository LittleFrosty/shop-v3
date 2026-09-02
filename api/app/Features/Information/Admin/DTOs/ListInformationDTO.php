<?php

namespace App\Features\Information\Admin\DTOs;

readonly class ListInformationDTO{
  public function __construct(public int $id) {}

  public static function fromArray(array $data): self{
    return new self(
      id: (int)$data['id'],
    );
  }
}