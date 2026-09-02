<?php

namespace App\Features\Blog\Admin\Queries;

use App\Features\Blog\Admin\DTOs\StoreBlogDTO;
use App\Features\Blog\Models\Blog;

class StoreBlogQuery{
  public function handle(StoreBlogDTO $dto): mixed{
    return Blog::query()->get();
  }
}
