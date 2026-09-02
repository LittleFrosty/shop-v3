<?php

namespace App\Features\Blog\Admin\DTOs;

readonly class StoreBlogDTO{
  public function __construct(public int $id) {}

  public static function fromArray(array $data): self{
    return new self(
      id: (int)$data['id'],
    );
  }
}