<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      "title" => "required|string|max:255",
      "url" => "required|unique:posts|alpha_dash|max:255",
      "content" => "required"
    ];
  }
}
