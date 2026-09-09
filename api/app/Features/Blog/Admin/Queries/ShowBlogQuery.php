<?php

namespace App\Features\Blog\Admin\Queries;

use App\Features\Blog\Admin\DTOs\ShowBlogDTO;
use App\Features\Blog\Models\Blog;

class ShowBlogQuery{
  public function handle(ShowBlogDTO $dto): Blog{
    return Blog::get();
  }
}
