<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class internetRequest extends FormRequest
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
            // 'Company'=>'required',
            'price'=>'required|numeric',
            'number'=>'required|numeric',
            'mobile_number'=>'required|numeric',
            'full_name'=>'required|string|min:1|max:100',
        ];
    }
    public function messages(){

        return [
            // 'Company.required'              =>__('Messages/message.this is filed required'),
            // 'number.numeric'               =>__('Messages/message.this is filed input numeric'),
            'price.required'            =>__('Messages/message.this is filed required'),
            'price.numeric'                =>__('Messages/message.this is filed input numeric'),
            'full_name.required'                     =>__('Messages/message.this is filed required'),
            'full_name.string'             =>__('Messages/message.this is filed input string'),
            'number.required'               =>__('Messages/message.this is filed required'),
            'number.numeric'                =>__('Messages/message.this is filed input numeric'),
            
        ];
    }
}
