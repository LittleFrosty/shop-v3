<?php

namespace App\Features\Media\Admin\DTOs;

readonly class ShowMediaDTO{
  public function __construct(public int $id) {}

  public static function fromArray(array $data): self{
    return new self(
      id: (int)$data['id'],
    );
  }
}