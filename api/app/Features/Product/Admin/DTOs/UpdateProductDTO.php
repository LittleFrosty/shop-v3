<?php

namespace App\Features\Product\Admin\DTOs;

readonly class UpdateProductDTO{
  public function __construct(
    public int $id,
    public array $product,
    public array $description,
    public ?array $categoryIds,
  ){}

  public static function fromArray(array $data): self{
    $productFields = [
      'price', 'discount', 'wholesale', 'model', 'barcode', 'weight',
      'youtube', 'quantity', 'bundle_of_models', 'out_of_stock_status',
      'brand_id', 'status', 'url', 'sort_order',
    ];
    $descriptionFields = [
      'title', 'description', 'meta_title', 'meta_description', 'tags',
    ];

    return new self(
      id: (int) $data['id'],
      product: array_intersect_key($data, array_flip($productFields)),
      description: array_intersect_key($data, array_flip($descriptionFields)),
      categoryIds: array_key_exists('category_ids', $data)
        ? array_map('intval', $data['category_ids'])
        : null,
    );
  }
}
