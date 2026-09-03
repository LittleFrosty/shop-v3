<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Features\Category\Admin\Actions\StoreCategoryAction;
use App\Features\Category\Admin\DTOs\StoreCategoryDTO;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
  public function run(): void{
    $payload = StoreCategoryDTO::fromArray([
      'top'               => true,
      'status'            => Status::ENABLED->value,
      'image'             => 'categories/demo.jpg',
      'slug'              => 'electronics',
      'parent_id'         => 0,
      'depth'             => 0,
      'sort_order'        => 1,
      'title'             => 'Electronics',
      'description'       => 'All electronics',
      'meta_title'        => 'Electronics',
      'meta_description'  => 'Shop electronics',
    ]);

    app(StoreCategoryAction::class)->handle($payload);
  }
}
