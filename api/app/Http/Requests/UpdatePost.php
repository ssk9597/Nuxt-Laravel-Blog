<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      "title" => "required|string|max:255",
      "url" => "required|alpha_dash|max:255",
      "content" => "required"
    ];
  }
}
