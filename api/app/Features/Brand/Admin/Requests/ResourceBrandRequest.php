<?php

namespace App\Features\Brand\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceBrandRequest extends FormRequest{
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
      'id.required' => 'Brand ID is required.',
      'id.integer'  => 'Brand ID must be a number.',
      'id.exists'   => 'The selected Brand does not exist.',
    ];
  }
}