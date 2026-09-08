<?php

namespace App\Features\Brand\Admin\DTOs;

readonly class UpdateBrandDTO{
  public function __construct(
    public int $id,
    public ?string $title = null,
    public ?string $description = null,
    public ?string $metaTitle = null,
    public ?string $metaDescription = null,
    public ?int $sortOrder = null,
    public ?string $slug = null,
    public ?string $image = null,
    public ?int $status = null,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      id: (int) $data['id'],
      title: $data['title'] ?? null,
      description: $data['description'] ?? null,
      metaTitle: $data['meta_title'] ?? null,
      metaDescription: $data['meta_description'] ?? null,
      sortOrder: isset($data['sort_order']) ? (int) $data['sort_order'] : null,
      slug: $data['slug'] ?? null,
      image: $data['image'] ?? null,
      status: isset($data['status']) ? (int) $data['status'] : null,
    );
  }

  public function changes(): array{
    return array_filter([
      'title' => $this->title,
      'description' => $this->description,
      'meta_title' => $this->metaTitle,
      'meta_description' => $this->metaDescription,
      'sort_order' => $this->sortOrder,
      'slug' => $this->slug,
      'image' => $this->image,
      'status' => $this->status,
    ], static fn (mixed $value): bool => $value !== null);
  }
}
