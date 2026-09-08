<?php

namespace App\Features\Brand\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListBrandResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      'id' => $this->id,
      'title' => $this->title,
      'description' => $this->description,
      'meta_title' => $this->meta_title,
      'meta_description' => $this->meta_description,
      'sort_order' => $this->sort_order,
      'slug' => $this->slug,
      'image' => $this->image,
      'status' => $this->status,
    ];
  }
}
