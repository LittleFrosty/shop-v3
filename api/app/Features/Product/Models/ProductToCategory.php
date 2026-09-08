<?php

namespace App\Features\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model{
  public $table = 'product_to_category';

  public $timestamps = false;

  protected $fillable = [
    'product_id',
    'category_id',
  ];
}
