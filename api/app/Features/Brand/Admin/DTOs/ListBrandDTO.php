<?php

namespace App\Features\Brand\Admin\DTOs;

readonly class ListBrandDTO{
  public function __construct(
    public ?string $title = null,
    public ?int $status = null,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      title: $data['title'] ?? null,
      status: isset($data['status']) ? (int) $data['status'] : null,
    );
  }
}
