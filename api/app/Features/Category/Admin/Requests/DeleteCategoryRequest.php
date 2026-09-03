<?php

namespace App\Features\Category\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest{
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
    return [];
  }

  public function messages(): array{
    return [
      'id.required' => 'Category ID is required.',
      'id.integer'  => 'Category ID must be a number.',
      'id.exists'   => 'The selected Category does not exist.',
    ];
  }
}
