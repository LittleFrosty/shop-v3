<?php

namespace App\Features\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}