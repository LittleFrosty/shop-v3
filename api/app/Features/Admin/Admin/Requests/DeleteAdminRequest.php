<?php

namespace App\Features\Admin\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAdminRequest extends FormRequest{
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
      'id.required' => 'Admin ID is required.',
      'id.integer'  => 'Admin ID must be a number.',
      'id.exists'   => 'The selected Admin does not exist.',
    ];
  }
}