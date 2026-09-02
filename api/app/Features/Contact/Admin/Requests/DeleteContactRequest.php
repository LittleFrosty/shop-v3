<?php

namespace App\Features\Contact\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteContactRequest extends FormRequest{
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
      'id.required' => 'Contact ID is required.',
      'id.integer'  => 'Contact ID must be a number.',
      'id.exists'   => 'The selected Contact does not exist.',
    ];
  }
}