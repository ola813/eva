<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
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
            'company_id'=>'required',
            'value'=>'required',
            'mobile_number'=>'required|numeric|digits:10',
        ];
    }
    public function messages(){

        return [
            'required'              =>__('Messages/message.this is filed required'),
            'mobile_number.required'       =>__('Messages/message.this is filed required'),
            'mobile_number.numeric'        =>__('Messages/message.this is filed input numeric'),
            'digits'                       =>__('Messages/message.this is filed required 10 number'),
            
        ];
}
public function forbiddenResponse()
{
    // Optionally, send a custom response on authorize failure 
    // (default is to just redirect to initial page with errors)
    // 
    // Can return a response, a view, a redirect, or whatever else
    return Response::make('Permission denied foo!', 422);
}
}
