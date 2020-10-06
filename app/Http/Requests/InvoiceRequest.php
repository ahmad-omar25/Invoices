<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'product' => 'required',
            'amount_collection' => 'required',
            'amount_commission' => 'required',
            'rate_vat' => 'required',
            'value_vat' => 'required',
            'total' => 'required',
            'note' => 'nullable',
            'discount' => 'nullable',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
