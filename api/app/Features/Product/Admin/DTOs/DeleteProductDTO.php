<?php

namespace App\Features\Product\Admin\DTOs;

readonly class DeleteProductDTO
{
    public function __construct()
    {
    }

    public static function fromArray(array $data): self
    {
        return new self();
    }
}