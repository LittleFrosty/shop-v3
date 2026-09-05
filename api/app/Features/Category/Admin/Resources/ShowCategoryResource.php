<?php

namespace App\Features\Category\Admin\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCategoryResource extends JsonResource{
  public function toArray(Request $reqest): array{
    
    $description = $this->description;

    return [
      'id'                => $this->id,
      'title'             => $description->title,
      'meta_title'        => $description->meta_title,
      'description'       => $description->description,
      'meta_description'  => $description->meta_description, 
      'views'             => $this->views,
      'status'            => $this->status,
      'slug'              => $this->slug,
      'image'             => $this->image,
      'parent_id'         => $this->parent_id,
      'depth'             => $this->depth,
      'sort_order'        => $this->sort_order,
      'created_at'        => $this->created_at ? Carbon::parse($this->created_at)->format("Y-m-d H:i:s") : null,
      'updated_at'        => $this->updated_at ? Carbon::parse($this->updated_at)->format("Y-m-d H:i:s") : null,
    ];
  }
}
