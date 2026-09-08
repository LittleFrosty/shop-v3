<?php

namespace App\Features\User\Admin\DTOs;

readonly class ListUserDTO{
  public function __construct(
    public ?string $name,
    public ?string $email,
    public ?int $status,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      name: $data['name'] ?? null,
      email: $data['email'] ?? null,
      status: isset($data['status']) ? (int) $data['status'] : null,
    );
  }
}
