<?php

namespace App\Features\Cart\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceCartRequest extends FormRequest{
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
      'id.required' => 'Cart ID is required.',
      'id.integer'  => 'Cart ID must be a number.',
      'id.exists'   => 'The selected Cart does not exist.',
    ];
  }
}