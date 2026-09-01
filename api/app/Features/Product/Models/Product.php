<?php

namespace App\Features\Product\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model{
  public $table = 'product';
  protected $fillable = [
    'product_id',
    'price',
    'discount',
    'wholesale',
    'model',
    'barcode',
    'weight',
    'youtube',
    'quantity',
    'bundle_of_models',
    'out_of_stock_status',
    'brand_id',
    'status',
    'sort_order',
  ];

  protected function casts():array{
    return [
      'status' => Status::class,
    ];
  }

  public function description():HasOne{
    return $this->hasOne(ProductDescription::class, 'product_id', 'id');
  }

  public function categories():HasMany{
    return $this->hasMany(ProductToCategory::class,'product_id','id');
  }
}