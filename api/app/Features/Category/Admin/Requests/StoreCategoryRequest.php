<?php

namespace App\Features\Category\Admin\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }
  ## Uncomment this for get ID routes so that the request works
  //protected function prepareForValidation(): void{
    //$this->merge([
      //'id' => $this->route('id'),
    //]);
  //}

  public function rules(): array{
    return [
      "top"               => ["required","boolean"],
      "status"            => ["required","string", Rule::enum(Status::class)],
      "image"             => ["required","string"],
      "slug"              => ["required","string","max:256"],
      "views"             => ["sometimes","integer","min:0"],
      "parent_id"         => ["required","integer","min:0"],
      "depth"             => ["required","integer","min:0"],
      "sort_order"        => ["required","integer"],
      "title"             => ["required","string"],
      "description"       => ["required","string"],
      "meta_title"        => ["required","string","max:256"],
      "meta_description"  => ["required","string","max:256"],
    ];
  }

  public function messages(): array{
    return [
      'top.required'              => 'Top is required.',
      'top.boolean'               => 'Top must be true or false.',
      'status.required'           => 'Status is required.',
      'image.required'            => 'Image is required.',
      'image.string'              => 'Image must be a string.',
      'slug.required'             => 'Slug is required.',
      'slug.string'               => 'Slug must be a string.',
      'slug.max'                  => 'Slug may not be greater than 256 characters.',
      'views.integer'             => 'Views must be a number.',
      'views.min'                 => 'Views must be at least 0.',
      'parent_id.required'        => 'Parent ID is required.',
      'parent_id.integer'         => 'Parent ID must be a number.',
      'parent_id.min'             => 'Parent ID must be at least 0.',
      'depth.required'            => 'Depth is required.',
      'depth.integer'             => 'Depth must be a number.',
      'depth.min'                 => 'Depth must be at least 0.',
      'sort_order.required'       => 'Sort order is required.',
      'sort_order.integer'        => 'Sort order must be a number.',
      'title.required'            => 'Title is required.',
      'description.required'      => 'Description is required.',
      'meta_title.required'       => 'Meta title is required.',
      'meta_title.max'            => 'Meta title may not be greater than 256 characters.',
      'meta_description.required' => 'Meta description is required.',
      'meta_description.max'      => 'Meta description may not be greater than 256 characters.',
    ];
  }
}
