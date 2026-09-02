<?php

namespace App\Features\Product\Admin\DTOs;

readonly class UpdateProductDTO
{
    public function __construct()
    {
    }

    public static function fromArray(array $data): self
    {
        return new self();
    }
}