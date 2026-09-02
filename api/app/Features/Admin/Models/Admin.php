<?php

namespace App\Features\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}