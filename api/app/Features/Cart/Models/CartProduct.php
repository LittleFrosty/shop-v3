<?php

namespace App\Features\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProduct extends Model{
  public $table = 'cart_products';

  protected $fillable = [
    'cart_id',
    'product_id',
    'title',
    'quantity',
    'image',
    'weight',
    'price',
    'option_price_total',
    'options',
    'options_ids',
    'discount',
    'total',
  ];

  protected function casts(): array{
    return [
      'cart_id' => 'integer',
      'product_id' => 'integer',
      'quantity' => 'integer',
      'weight' => 'decimal:2',
      'price' => 'decimal:2',
      'option_price_total' => 'decimal:2',
      'discount' => 'decimal:2',
      'total' => 'decimal:2',
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }

  public function cart(): BelongsTo{
    return $this->belongsTo(Cart::class, 'cart_id', 'id');
  }
}
