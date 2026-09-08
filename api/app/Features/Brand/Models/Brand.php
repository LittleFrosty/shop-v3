<?php

namespace App\Features\Brand\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model{
  public $timestamps = false;

  protected $table = 'brand';

  protected $fillable = [
    'title',
    'description',
    'meta_title',
    'meta_description',
    'sort_order',
    'slug',
    'image',
    'status',
  ];

  protected function casts(): array{
    return [
      'sort_order' => 'integer',
      'status' => 'integer',
    ];
  }
}
