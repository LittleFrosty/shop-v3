<?php

namespace App\Features\Information\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowInformationResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      'id' => $this->id,
      'title' => $this->title,
      'thumbnail' => $this->thumbnail,
      'description' => $this->description,
      'status' => $this->status,
      'agreements_at_order' => $this->agreements_at_order,
      'agreement_at_contacts' => $this->agreement_at_contacts,
      'show_in_footer' => $this->show_in_footer,
      'sort_order' => $this->sort_order,
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
      'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
    ];
  }
}
