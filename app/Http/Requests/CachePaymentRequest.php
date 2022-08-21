<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CachePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'account_number'=>'required|numeric|digits:10',
            'method_payment'=>'required',
            'Bill_price'=>'required|numeric',
        ];
    }
    public function messages(){

        return [
            'required'                     =>__('Messages/message.this is filed required'),
            'numeric'                      =>__('Messages/message.this is filed input numeric'),
            'digits'                    =>__('Messages/message.this is filed required 10 number'),
            
        ];
    }
}
