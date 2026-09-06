<?php

namespace App\Features\Category\Admin\DTOs;

use App\Enums\Status;

readonly class ListCategoryDTO{
  public function __construct(
    public ?string $title = null,
    public ?Status $status = null,
  ) {}

  public static function fromArray(array $data): self{
    return new self(
      title: $data['title'] ?? null,
      status: isset($data['status'])
        ? Status::from($data['status'])
        : null,
    );
  }
}
