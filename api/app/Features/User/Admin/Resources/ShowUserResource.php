<?php

namespace App\Features\User\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      'id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'company' => $this->company,
      'phone' => $this->phone,
      'country' => $this->country,
      'city' => $this->city,
      'address' => $this->address,
      'status' => $this->status,
      'wholesale' => $this->wholesale,
      'wholesale_profile' => $this->wholesale_profile,
      'total_sum' => $this->total_sum,
      'email_verified_at' => $this->email_verified_at?->toISOString(),
      'created_at' => $this->created_at?->toISOString(),
      'updated_at' => $this->updated_at?->toISOString(),
    ];
  }
}
