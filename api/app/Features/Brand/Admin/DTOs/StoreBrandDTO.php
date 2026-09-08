<?php

namespace App\Features\Brand\Admin\DTOs;

readonly class StoreBrandDTO{
  public function __construct(
    public string $title,
    public string $description,
    public string $metaTitle,
    public string $metaDescription,
    public int $sortOrder,
    public string $slug,
    public string $image,
    public int $status,
  ){}

  public static function fromArray(array $data): self{
    return new self(
      title: $data['title'],
      description: $data['description'],
      metaTitle: $data['meta_title'],
      metaDescription: $data['meta_description'],
      sortOrder: (int) $data['sort_order'],
      slug: $data['slug'],
      image: $data['image'],
      status: (int) $data['status'],
    );
  }

  public function toArray(): array{
    return [
      'title' => $this->title,
      'description' => $this->description,
      'meta_title' => $this->metaTitle,
      'meta_description' => $this->metaDescription,
      'sort_order' => $this->sortOrder,
      'slug' => $this->slug,
      'image' => $this->image,
      'status' => $this->status,
    ];
  }
}
