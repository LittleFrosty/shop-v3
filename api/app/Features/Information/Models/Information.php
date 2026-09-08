<?php

namespace App\Features\Information\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model{
  protected $table = 'information';

  protected $fillable = [
    'title',
    'thumbnail',
    'description',
    'status',
    'agreements_at_order',
    'agreement_at_contacts',
    'show_in_footer',
    'sort_order',
  ];

  protected function casts(): array{
    return [
      'status' => 'integer',
      'agreements_at_order' => 'integer',
      'agreement_at_contacts' => 'integer',
      'show_in_footer' => 'integer',
      'sort_order' => 'integer',
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }
}
