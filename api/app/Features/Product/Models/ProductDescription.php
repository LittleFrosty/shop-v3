<?php

namespace App\Features\Product\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model{
  public $table = 'product_description';

  public $timestamps = false;

  protected $fillable = [
    'product_id',
    'title',
    'description',
    'meta_title',
    'meta_description',
    'tags',
  ];
}
