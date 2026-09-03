<?php

namespace App\Features\Category\Admin\DTOs;

use App\Enums\Status;

readonly class StoreCategoryDTO{
  public function __construct(
    public bool $top,
    public Status $status,
    public string $image,
    public string $slug,
    public int $parent_id,
    public int $depth,
    public int $sort_order,
    public string $title,
    public string $description,
    public string $meta_title,
    public string $meta_description,
  ) {}

  public static function fromArray(array $data): self{
    return new self(
      top:              $data["top"],
      status:           Status::from($data["status"]),
      image:            $data["image"],
      slug:             $data["slug"],
      parent_id:        $data["parent_id"],
      depth:            $data["depth"],
      sort_order:       $data["sort_order"],
      title:            $data["title"],
      description:      $data["description"],
      meta_title:       $data["meta_title"],
      meta_description: $data["meta_description"],
    );
  }
}
