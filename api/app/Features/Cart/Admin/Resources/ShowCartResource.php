<?php

namespace App\Features\Cart\Admin\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCartResource extends JsonResource{
  public function toArray(Request $request): array{
    return [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'cart_token' => $this->cart_token,
      'voucher_code' => $this->voucher_code,
      'active_cart' => $this->active_cart,
      'token' => $this->token,
      'name' => $this->name,
      'email' => $this->email,
      'additional_details' => $this->additional_details,
      'phone' => $this->phone,
      'city' => $this->city,
      'address' => $this->address,
      'company' => $this->company,
      'payment_method' => $this->payment_method,
      'payment_status' => $this->payment_status,
      'additional_charges' => $this->additional_charges,
      'additional_charges_total' => $this->additional_charges_total,
      'weight_price' => $this->weight_price,
      'delivery_method' => $this->delivery_method,
      'external_delivery_method' => $this->external_delivery_method,
      'delivery_price' => $this->delivery_price,
      'tracking_number' => $this->tracking_number,
      'status' => $this->status?->value,
      'product_count' => $this->whenCounted('products'),
      'products' => $this->whenLoaded('products', fn () => $this->products->map(
        fn ($product): array => [
          'id' => $product->id,
          'cart_id' => $product->cart_id,
          'product_id' => $product->product_id,
          'title' => $product->title,
          'quantity' => $product->quantity,
          'image' => $product->image,
          'weight' => $product->weight,
          'price' => $product->price,
          'option_price_total' => $product->option_price_total,
          'options' => $product->options,
          'options_ids' => $product->options_ids,
          'discount' => $product->discount,
          'total' => $product->total,
          'created_at' => $product->created_at?->format('Y-m-d H:i:s'),
          'updated_at' => $product->updated_at?->format('Y-m-d H:i:s'),
        ],
      )->values()),
      'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
      'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
    ];
  }
}
