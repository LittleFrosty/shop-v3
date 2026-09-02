<?php

namespace App\Features\Information\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}