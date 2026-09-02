<?php

namespace App\Features\Blog\Admin\Queries;

use App\Features\Blog\Admin\DTOs\ResourceBlogDTO;
use App\Features\Blog\Models\Blog;

class ResourceBlogQuery{
  public function handle(ResourceBlogDTO $dto): mixed{
    return Blog::query()->get();
  }
}
