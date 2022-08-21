<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title'=>'required|Alpha_dash|Alpha_num',
            'point'=>'required|integer',
            'price_point'=>'required|integer',
            'price_act'=>'required|integer',
            'orginal_price'=>'required|integer',
            'selling_price'=>'required|integer',
            'quantity'=>'required|integer',
            'photo'=>'image|required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages(){

        return [
            'required'                        =>__('Messages/message.this is filed required'),
            'photo.image'                           =>__('Messages/message.this is filed image'),
            'photo.mimes:jpeg,png,jpg,gif'          =>__('Messages/message.this is input image jpeg'),
            'alpha_num'                             =>__('Messages/message.this is filed input numeric and string and dash'),
            'alpha_dash'                            =>  __('Messages/message.this is filed input numeric and string and dash'),
        ];
    }
}
