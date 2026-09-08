<?php

namespace App\Features\Information\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInformationRequest extends FormRequest{
  public function authorize(): bool{
    return true;
  }

  public function rules(): array{
    return [
      'title' => ['required', 'string', 'max:256'],
      'thumbnail' => ['nullable', 'string', 'max:256'],
      'description' => ['required', 'string'],
      'status' => ['required', 'integer', Rule::in([0, 1])],
      'agreements_at_order' => ['required', 'integer', Rule::in([0, 1])],
      'agreement_at_contacts' => ['required', 'integer', Rule::in([0, 1])],
      'show_in_footer' => ['required', 'integer', Rule::in([0, 1])],
      'sort_order' => ['required', 'integer', 'min:0'],
    ];
  }
}
