<?php

namespace App\Features\Cart\Admin\DTOs;

use App\Enums\CartStatus;

readonly class ListCartDTO{
  public function __construct(
    public ?CartStatus $status = null,
    public ?string $email = null,
    public ?string $name = null,
    public ?string $createdFrom = null,
    public ?string $createdTo = null,
  ) {}

  public static function fromArray(array $data): self{
    return new self(
      status: isset($data['status']) ? CartStatus::from($data['status']) : null,
      email: $data['email'] ?? null,
      name: $data['name'] ?? null,
      createdFrom: $data['created_from'] ?? null,
      createdTo: $data['created_to'] ?? null,
    );
  }
}
