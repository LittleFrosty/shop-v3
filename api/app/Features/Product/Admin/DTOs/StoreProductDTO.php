<?php

namespace App\Features\Product\Admin\DTOs;

use App\Enums\Status;

readonly class StoreProductDTO{
  public function __construct(
    public float $price,
    public float $discount,
    public float $wholesale,
    public string $model,
    public ?string $barcode,
    public float $weight,
    public ?string $youtube,
    public int $quantity,
    public ?string $bundleOfModels,
    public int $outOfStockStatus,
    public ?int $brandId,
    public Status $status,
    public string $url,
    public int $sortOrder,
    public string $title,
    public string $description,
    public ?string $metaTitle,
    public ?string $metaDescription,
    public string $tags,
    public array $categoryIds,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      price: (float) $data['price'],
      discount: (float) $data['discount'],
      wholesale: (float) $data['wholesale'],
      model: $data['model'],
      barcode: $data['barcode'] ?? null,
      weight: (float) $data['weight'],
      youtube: $data['youtube'] ?? null,
      quantity: (int) $data['quantity'],
      bundleOfModels: $data['bundle_of_models'] ?? null,
      outOfStockStatus: (int) $data['out_of_stock_status'],
      brandId: isset($data['brand_id']) ? (int) $data['brand_id'] : null,
      status: Status::from($data['status']),
      url: $data['url'],
      sortOrder: (int) $data['sort_order'],
      title: $data['title'],
      description: $data['description'],
      metaTitle: $data['meta_title'] ?? null,
      metaDescription: $data['meta_description'] ?? null,
      tags: $data['tags'],
      categoryIds: array_map('intval', $data['category_ids']),
    );
  }
}
