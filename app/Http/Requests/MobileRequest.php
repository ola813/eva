<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobileRequest extends FormRequest
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
            'Company'=>'required|not_in:0',
            'mobile_number'=>'required|numeric',
            'veryfiy_number'=>'required|numeric',
            'price'=>'required|numeric',
        ];
    }
    public function messages(){

        return [
            'Company.required'              =>__('Messages/message.this is filed required'),
            'Company.not_in'              =>__('Messages/message.you must chooes'),
            'mobile_number.required'            =>__('Messages/message.this is filed required'),
            'mobile_number.numeric'             =>__('Messages/message.this is filed input numeric'),
            'veryfiy_number.required'               =>__('Messages/message.this is filed required'),
            'veryfiy_number.numeric'                =>__('Messages/message.this is filed input numeric'),
            'price.required'                     =>__('Messages/message.this is filed required'),
            'price.numeric'               =>__('Messages/message.this is filed input numeric'),
            
        ];
    }
}
