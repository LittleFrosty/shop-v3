<?php

namespace App\Features\Product\Admin\DTOs;

use App\Enums\Status;

readonly class ListProductDTO{
  public function __construct(
    public ?string $title = null,
    public ?string $model = null,
    public ?Status $status = null,
    public ?int $brandId = null,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      title: $data['title'] ?? null,
      model: $data['model'] ?? null,
      status: isset($data['status']) ? Status::from($data['status']) : null,
      brandId: isset($data['brand_id']) ? (int) $data['brand_id'] : null,
    );
  }
}
