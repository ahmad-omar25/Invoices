<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'section_id' => 'required|min:1',
            'description' => 'nullable|max:300',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
