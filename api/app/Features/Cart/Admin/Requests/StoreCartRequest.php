<?php

namespace App\Features\Cart\Admin\Requests;

use App\Enums\CartStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCartRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'user_id' => ['nullable', 'integer', 'exists:users,id'],
      'cart_token' => ['nullable', 'string', 'max:64', 'unique:cart,cart_token'],
      'voucher_code' => ['nullable', 'string', 'max:256'],
      'active_cart' => ['required', 'integer'],
      'token' => ['nullable', 'string', 'max:64', 'unique:cart,token'],
      'name' => ['required', 'string', 'max:256'],
      'email' => ['required', 'email', 'max:256'],
      'additional_details' => ['nullable', 'string'],
      'phone' => ['required', 'string', 'max:256'],
      'city' => ['required', 'string', 'max:256'],
      'address' => ['required', 'string', 'max:256'],
      'company' => ['required', 'string'],
      'payment_method' => ['required', 'string', 'max:256'],
      'payment_status' => ['nullable', 'string', 'max:256'],
      'payment_token' => ['nullable', 'string', 'max:256'],
      'additional_charges' => ['nullable', 'string'],
      'additional_charges_total' => ['nullable', 'numeric', 'min:0'],
      'weight_price' => ['nullable', 'numeric', 'min:0'],
      'delivery_method' => ['required', 'string', 'max:256'],
      'external_delivery_method' => ['nullable', 'string', 'max:256'],
      'delivery_price' => ['required', 'numeric', 'min:0'],
      'tracking_number' => ['nullable', 'string'],
      'status' => ['required', 'string', Rule::enum(CartStatus::class)],
      'products' => ['required', 'array', 'min:1'],
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
