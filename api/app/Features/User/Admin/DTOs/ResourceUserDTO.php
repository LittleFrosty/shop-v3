<?php

namespace App\Features\User\Admin\DTOs;

readonly class ResourceUserDTO{
  public function __construct(public int $id) {}

  public static function fromArray(array $data): self{
    return new self(
      id: (int)$data['id'],
    );
  }
}