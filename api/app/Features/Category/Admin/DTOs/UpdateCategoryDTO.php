<?php

namespace App\Features\Category\Admin\DTOs;

readonly class UpdateCategoryDTO{
  public function __construct(
    public int $id,
    public array $category,
    public array $description,
  ) {}

  public static function fromArray(array $data): self{
    $categoryFields = [
      'top',
      'status',
      'image',
      'slug',
      'views',
      'parent_id',
      'depth',
      'sort_order',
    ];
    $descriptionFields = [
      'title',
      'description',
      'meta_title',
      'meta_description',
    ];

    return new self(
      id: (int)$data['id'],
      category: array_intersect_key($data, array_flip($categoryFields)),
      description: array_intersect_key($data, array_flip($descriptionFields)),
    );
  }
}
