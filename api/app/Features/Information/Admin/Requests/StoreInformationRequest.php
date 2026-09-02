<?php

namespace App\Features\Information\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformationRequest extends FormRequest{
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
      'id.required' => 'Information ID is required.',
      'id.integer'  => 'Information ID must be a number.',
      'id.exists'   => 'The selected Information does not exist.',
    ];
  }
}