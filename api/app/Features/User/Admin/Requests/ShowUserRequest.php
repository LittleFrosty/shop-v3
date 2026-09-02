<?php

namespace App\Features\User\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest{
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
      'id.required' => 'User ID is required.',
      'id.integer'  => 'User ID must be a number.',
      'id.exists'   => 'The selected User does not exist.',
    ];
  }
}