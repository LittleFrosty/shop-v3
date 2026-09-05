<?php

namespace App\Features\Category\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryDescription extends Model{
  public $table = "category_description";
  public $fillable = [
    'title',
    'description',
    'meta_title',
    'meta_description',
  ];
  public $timestamps = false;

  public function category():BelongsTo{
    return $this->belongsTo(Category::class,"category_id");
  }
}
