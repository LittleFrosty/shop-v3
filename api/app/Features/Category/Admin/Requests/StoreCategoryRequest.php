<?php

namespace App\Features\Category\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
      "top"               => ["required"],
      "status"            => ["required"],
      "image"             => ["required"],
      "slug"              => ["required"],
      "parent_id"         => ["required"],
      "depth"             => ["required"],
      "sort_order"        => ["required"],
      "title"             => ["required"],
      "description"       => ["required"],
      "meta_title"        => ["required"],
      "meta_description"  => ["required"],
    ];
  }

  public function messages(): array{
    return [
      'id.required' => 'Category ID is required.',
      'id.integer'  => 'Category ID must be a number.',
      'id.exists'   => 'The selected Category does not exist.',
    ];
  }
}
