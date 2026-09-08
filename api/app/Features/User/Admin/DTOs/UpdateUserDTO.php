<?php

namespace App\Features\User\Admin\DTOs;

readonly class UpdateUserDTO{
  public function __construct(
    public int $id,
    public array $attributes,
  ){}

  public static function fromArray(array $data): self{
    $fields = [
      'name',
      'email',
      'company',
      'phone',
      'password',
      'country',
      'city',
      'address',
      'status',
      'wholesale',
      'wholesale_profile',
      'total_sum',
      'email_verified_at',
    ];

    return new self(
      id: (int) $data['id'],
      attributes: array_intersect_key($data, array_flip($fields)),
    );
  }
}
