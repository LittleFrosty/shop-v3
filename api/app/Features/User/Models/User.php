<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}