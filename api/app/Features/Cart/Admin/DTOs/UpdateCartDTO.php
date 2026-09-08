<?php

namespace App\Features\Cart\Admin\DTOs;

readonly class UpdateCartDTO{
  public function __construct(
    public int $id,
    public array $cart,
    public ?array $products,
  ) {}

  public static function fromArray(array $data): self{
    $cartFields = [
      'user_id', 'cart_token', 'voucher_code', 'active_cart', 'token',
      'name', 'email', 'additional_details', 'phone', 'city', 'address',
      'company', 'payment_method', 'payment_status', 'payment_token',
      'additional_charges', 'additional_charges_total', 'weight_price',
      'delivery_method', 'external_delivery_method', 'delivery_price',
      'tracking_number', 'status',
    ];

    return new self(
      id: (int) $data['id'],
      cart: array_intersect_key($data, array_flip($cartFields)),
      products: array_key_exists('products', $data) ? $data['products'] : null,
    );
  }
}
