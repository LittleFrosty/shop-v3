<?php

namespace App\Features\Cart\Admin\DTOs;

use App\Enums\CartStatus;

readonly class StoreCartDTO{
  public function __construct(
    public ?int $userId,
    public ?string $cartToken,
    public ?string $voucherCode,
    public int $activeCart,
    public ?string $token,
    public string $name,
    public string $email,
    public ?string $additionalDetails,
    public string $phone,
    public string $city,
    public string $address,
    public string $company,
    public string $paymentMethod,
    public ?string $paymentStatus,
    public ?string $paymentToken,
    public ?string $additionalCharges,
    public ?float $additionalChargesTotal,
    public ?float $weightPrice,
    public string $deliveryMethod,
    public ?string $externalDeliveryMethod,
    public float $deliveryPrice,
    public ?string $trackingNumber,
    public CartStatus $status,
    public array $products,
  ) {}

  public static function fromArray(array $data): self{
    return new self(
      userId: isset($data['user_id']) ? (int) $data['user_id'] : null,
      cartToken: $data['cart_token'] ?? null,
      voucherCode: $data['voucher_code'] ?? null,
      activeCart: (int) $data['active_cart'],
      token: $data['token'] ?? null,
      name: $data['name'],
      email: $data['email'],
      additionalDetails: $data['additional_details'] ?? null,
      phone: $data['phone'],
      city: $data['city'],
      address: $data['address'],
      company: $data['company'],
      paymentMethod: $data['payment_method'],
      paymentStatus: $data['payment_status'] ?? null,
      paymentToken: $data['payment_token'] ?? null,
      additionalCharges: $data['additional_charges'] ?? null,
      additionalChargesTotal: isset($data['additional_charges_total']) ? (float) $data['additional_charges_total'] : null,
      weightPrice: isset($data['weight_price']) ? (float) $data['weight_price'] : null,
      deliveryMethod: $data['delivery_method'],
      externalDeliveryMethod: $data['external_delivery_method'] ?? null,
      deliveryPrice: (float) $data['delivery_price'],
      trackingNumber: $data['tracking_number'] ?? null,
      status: CartStatus::from($data['status']),
      products: $data['products'],
    );
  }

  public function cartAttributes(): array{
    return [
      'user_id' => $this->userId,
      'cart_token' => $this->cartToken,
      'voucher_code' => $this->voucherCode,
      'active_cart' => $this->activeCart,
      'token' => $this->token,
      'name' => $this->name,
      'email' => $this->email,
      'additional_details' => $this->additionalDetails,
      'phone' => $this->phone,
      'city' => $this->city,
      'address' => $this->address,
      'company' => $this->company,
      'payment_method' => $this->paymentMethod,
      'payment_status' => $this->paymentStatus,
      'payment_token' => $this->paymentToken,
      'additional_charges' => $this->additionalCharges,
      'additional_charges_total' => $this->additionalChargesTotal,
      'weight_price' => $this->weightPrice,
      'delivery_method' => $this->deliveryMethod,
      'external_delivery_method' => $this->externalDeliveryMethod,
      'delivery_price' => $this->deliveryPrice,
      'tracking_number' => $this->trackingNumber,
      'status' => $this->status->value,
    ];
  }
}
