<?php

namespace App\Features\Compare\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowCompareRequest extends FormRequest{
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
      'id.required' => 'Compare ID is required.',
      'id.integer'  => 'Compare ID must be a number.',
      'id.exists'   => 'The selected Compare does not exist.',
    ];
  }
}