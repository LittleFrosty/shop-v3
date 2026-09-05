<?php

namespace App\Features\Category\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model{
  public $table = 'category';
  public $timestamps = true;
  protected $fillable = [
    "top",
    "status",
    "image",
    "slug",
    "views",
    "parent_id",
    "depth",
    "sort_order",
  ];

  protected function casts(): array{
    return [
      'status'      => Status::class,
      'created_at'  => "datetime",
      'updated_at'  => "datetime",
    ];
  }
  public function description():HasOne{
    return $this->hasOne(CategoryDescription::class,"category_id");
  }
}
