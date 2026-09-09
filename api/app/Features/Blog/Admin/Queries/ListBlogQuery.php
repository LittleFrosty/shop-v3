<?php

namespace App\Features\Blog\Admin\Queries;

use App\Features\Blog\Admin\DTOs\ListBlogDTO;
use App\Features\Blog\Models\Blog;

class ListBlogQuery{
  public function handle(ListBlogDTO $dto): Blog{
    return Blog::get();
  }
}
