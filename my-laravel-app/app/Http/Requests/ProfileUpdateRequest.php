<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }

  /**
   * バリデーションルール
   */
public function rules(): array
{
    return[
        'name'        => ['required', 'string', 'max:255'],
        'price'       => ['required', 'integer', 'min:0'],
        'stock'       => ['required', 'integer', 'min:0'],
        'description' => ['nullable', 'string'],
        'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
    ];
}
}
