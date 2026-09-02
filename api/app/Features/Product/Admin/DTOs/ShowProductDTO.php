<?php

namespace App\Features\Product\Admin\DTOs;

readonly class ShowProductDTO{
  public function __construct(public int $id) {}

  public static function fromArray(array $data): self{
      return new self(
        id: (int)$data['id'],
      );
  }
}
