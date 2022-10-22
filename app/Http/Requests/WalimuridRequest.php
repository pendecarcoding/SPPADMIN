<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalimuridRequest extends FormRequest
{

    public function rules()
    {
        return [
          'nama'=>'required',
          'alamat'=>'required',
          'nohp'=>'required',
          'email'=>'required',
      ];
    }
}
