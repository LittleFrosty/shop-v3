<?php

namespace App\Features\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductToCategory extends Model{
  public $primaryKey = 'id';
  public $table = 'product_to_category';
}
