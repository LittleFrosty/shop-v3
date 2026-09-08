<?php

namespace App\Features\Product\Admin\DTOs;

readonly class DeleteProductDTO{
  public function __construct(public int $id){}

  public static function fromArray(array $data): self{
    return new self(id: (int) $data['id']);
  }
}
