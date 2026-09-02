<?php

namespace App\Features\Compare\Models;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}