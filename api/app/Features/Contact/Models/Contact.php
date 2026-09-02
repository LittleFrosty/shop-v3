<?php

namespace App\Features\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model{
  protected $guarded = [];
  public $table = '';
  protected $fillable = [];
  public $timestamps = false;
}