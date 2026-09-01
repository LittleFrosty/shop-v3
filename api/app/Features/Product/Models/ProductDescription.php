<?php

namespace App\Features\Product\Models;

use Illuminate\Database\Eloquent\Model;
use App\Features\Product\Models\Product;

class ProductDescription extends Model{
  public $table = 'product_description';
  protected $fillable = [
    'product_id',
    'title',
    'description',
    'tags',
  ];
}
