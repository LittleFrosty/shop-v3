<?php

namespace App\Features\Cart\Admin\Requests;

use App\Enums\CartStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCartRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  protected function prepareForValidation(): void{
    $this->merge(['id' => $this->route('id')]);
  }

  public function rules(): array{
    $cartId = $this->route('id');

    return [
      'id' => ['required', 'integer', 'exists:cart,id'],
      'user_id' => ['sometimes', 'nullable', 'integer', 'exists:users,id'],
      'cart_token' => ['sometimes', 'nullable', 'string', 'max:64', Rule::unique('cart', 'cart_token')->ignore($cartId)],
      'voucher_code' => ['sometimes', 'nullable', 'string', 'max:256'],
      'active_cart' => ['sometimes', 'integer'],
      'token' => ['sometimes', 'nullable', 'string', 'max:64', Rule::unique('cart', 'token')->ignore($cartId)],
      'name' => ['sometimes', 'string', 'max:256'],
      'email' => ['sometimes', 'email', 'max:256'],
      'additional_details' => ['sometimes', 'nullable', 'string'],
      'phone' => ['sometimes', 'string', 'max:256'],
      'city' => ['sometimes', 'string', 'max:256'],
      'address' => ['sometimes', 'string', 'max:256'],
      'company' => ['sometimes', 'string'],
      'payment_method' => ['sometimes', 'string', 'max:256'],
      'payment_status' => ['sometimes', 'nullable', 'string', 'max:256'],
      'payment_token' => ['sometimes', 'nullable', 'string', 'max:256'],
      'additional_charges' => ['sometimes', 'nullable', 'string'],
      'additional_charges_total' => ['sometimes', 'nullable', 'numeric', 'min:0'],
      'weight_price' => ['sometimes', 'nullable', 'numeric', 'min:0'],
      'delivery_method' => ['sometimes', 'string', 'max:256'],
      'external_delivery_method' => ['sometimes', 'nullable', 'string', 'max:256'],
      'delivery_price' => ['sometimes', 'numeric', 'min:0'],
      'tracking_number' => ['sometimes', 'nullable', 'string'],
      'status' => ['sometimes', 'string', Rule::enum(CartStatus::class)],
      'products' => ['sometimes', 'array'],
      'products.*.product_id' => ['required', 'integer', 'exists:product,id'],
      'products.*.title' => ['required', 'string', 'max:255'],
      'products.*.quantity' => ['required', 'integer', 'min:1'],
      'products.*.image' => ['required', 'string', 'max:255'],
      'products.*.weight' => ['nullable', 'numeric', 'min:0'],
      'products.*.price' => ['required', 'numeric', 'min:0'],
      'products.*.option_price_total' => ['nullable', 'numeric', 'min:0'],
      'products.*.options' => ['nullable', 'string'],
      'products.*.options_ids' => ['nullable', 'string', 'max:255'],
      'products.*.discount' => ['required', 'numeric', 'min:0'],
      'products.*.total' => ['required', 'numeric', 'min:0'],
    ];
  }
}
