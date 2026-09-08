<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
  protected $table = 'users';

  public $timestamps = true;

  protected $fillable = [
    'name',
    'email',
    'company',
    'phone',
    'password',
    'country',
    'city',
    'address',
    'status',
    'wholesale',
    'wholesale_profile',
    'total_sum',
    'email_verified_at',
  ];

  protected $hidden = [
    'password',
    'remember_token',
    'facebook_access_token',
    'google_access_token',
  ];

  protected function casts(): array{
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'status' => 'integer',
      'wholesale' => 'boolean',
      'wholesale_profile' => 'integer',
      'total_sum' => 'decimal:2',
    ];
  }
}
