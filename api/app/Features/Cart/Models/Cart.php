<?php

namespace App\Features\Cart\Models;

use App\Enums\CartStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model{
  public $table = 'cart';

  protected $fillable = [
    'user_id',
    'cart_token',
    'voucher_code',
    'active_cart',
    'token',
    'name',
    'email',
    'additional_details',
    'phone',
    'city',
    'address',
    'company',
    'payment_method',
    'payment_status',
    'payment_token',
    'additional_charges',
    'additional_charges_total',
    'weight_price',
    'delivery_method',
    'external_delivery_method',
    'delivery_price',
    'tracking_number',
    'status',
  ];

  protected function casts(): array{
    return [
      'user_id' => 'integer',
      'active_cart' => 'integer',
      'additional_charges_total' => 'decimal:2',
      'weight_price' => 'decimal:2',
      'delivery_price' => 'decimal:2',
      'status' => CartStatus::class,
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }

  public function products(): HasMany{
    return $this->hasMany(CartProduct::class, 'cart_id', 'id');
  }
}
