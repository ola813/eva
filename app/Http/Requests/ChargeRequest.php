<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'account'=>'required|numeric',
            'type'=>'required',
            'image'=>'image|required|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ];
    }
    public function messages(){

        return [
            'account.required'              =>__('Messages/message.this is filed required'),
            'account.numeric'               =>__('Messages/message.this is filed input numeric'),
            'type.required'                 =>__('Messages/message.this is filed required'),
            'image.required'                =>__('Messages/message.this is filed required'),
            'image.image'                   =>__('Messages/message.this is filed image'),
            'mimes'  =>__('Messages/message.this is input image jpeg'),
            'image.max:8192'                =>__('Messages/message.this is images size 8M'),
        ];
    }
    
}
