<?php

namespace App\Features\Category\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListCategoryResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      'id'                => $this->id,
      'title'             => $this->description->title,
      'description'       => $this->description->description,
      'meta_title'        => $this->description->meta_title,
      'meta_description'  => $this->description->meta_description,
      'status'            => $this->status,
      'slug'              => $this->slug,
      'image'             => $this->image,
      'parent_id'         => $this->parent_id,
      'depth'             => $this->depth,
      'sort_order'        => $this->sort_order,
      'views'             => $this->views,
      'children'          => ListCategoryResource::collection(
        $this->whenLoaded('children')
      ),
      'created_at'        => $this->created_at?->format('Y-m-d H:i:s'),
      'updated_at'        => $this->updated_at?->format('Y-m-d H:i:s'),
    ];
  }
}
