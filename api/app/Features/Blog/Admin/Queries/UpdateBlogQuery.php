<?php

namespace App\Features\Blog\Admin\Queries;

use App\Features\Blog\Admin\DTOs\UpdateBlogDTO;
use App\Features\Blog\Models\Blog;

class UpdateBlogQuery{
  public function handle(UpdateBlogDTO $dto): mixed{
    return Blog::query()->get();
  }
}
