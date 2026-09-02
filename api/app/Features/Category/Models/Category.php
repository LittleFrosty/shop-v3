<?php

namespace App\Features\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}