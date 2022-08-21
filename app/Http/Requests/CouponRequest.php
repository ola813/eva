<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_option'=>'required',
            'coupon_code'=>'required',
            'coupon_type'=>'required',
            'amount_type'=>'required',
            'amount'=>'required',
            'products[]'=>'required',
            'users[]'=>'required',
            'expiry_date'=>'required',
    
        ];
    }
    public function messages(){

        return [
            'required'                        =>__('Messages/message.this is filed required'),
        ];
    }
}
