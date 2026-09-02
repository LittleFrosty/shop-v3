<?php

namespace App\Features\Media\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceMediaRequest extends FormRequest{
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
      'id.required' => 'Media ID is required.',
      'id.integer'  => 'Media ID must be a number.',
      'id.exists'   => 'The selected Media does not exist.',
    ];
  }
}