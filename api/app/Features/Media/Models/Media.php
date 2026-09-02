<?php

namespace App\Features\Media\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}