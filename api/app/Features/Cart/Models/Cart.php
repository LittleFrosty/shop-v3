<?php

namespace App\Features\Cart\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}