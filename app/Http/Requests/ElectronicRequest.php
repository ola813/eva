<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ElectronicRequest extends FormRequest
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
            'counter_number'=>'required|numeric',
            'recorde_register'=>'required|numeric',
            'mobile_number'=>'required|numeric|digits:10',
            'country'=>'required',
        ];
    }
    public function messages(){

        return [
            'counter_number.required'              =>__('Messages/message.this is filed required'),
            'counter_number.numeric'               =>__('Messages/message.this is filed input numeric'),
            'recorde_register.required'            =>__('Messages/message.this is filed required'),
            'recorde_register.numeric'             =>__('Messages/message.this is filed input numeric'),
            'mobile_number.required'               =>__('Messages/message.this is filed required'),
            'mobile_number.numeric'                =>__('Messages/message.this is filed input numeric'),
            'country.required'                     =>__('Messages/message.this is filed required'),
            'digits'                               =>__('Messages/message.this is filed required 10 number'),
       
        ];
    }
}
