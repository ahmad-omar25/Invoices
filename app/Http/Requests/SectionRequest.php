<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable|max:300',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
