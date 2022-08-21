<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title_en'=>'required|Alpha_dash|Alpha_num',
            'category_ar'=>'required|Alpha_dash|Alpha_num',
            'category_en'=>'required|Alpha_dash|Alpha_num',
            'photo'=>'image|required|mimes:jpeg,png,jpg,gif,svg',
        
        ];
    }
    public function messages(){

        return [
            'title_en.required'                     =>__('Messages/message.this is filed required'),
            'category_ar.required'                  =>__('Messages/message.this is filed required'),
            'category_en.required'                  =>__('Messages/message.this is filed required'),
            'photo.required'                        =>__('Messages/message.this is filed required'),
            'photo.image'                           =>__('Messages/message.this is filed image'),
            'photo.mimes:jpeg,png,jpg,gif'          =>__('Messages/message.this is input image jpeg'),
            'alpha_num'                             =>__('Messages/message.this is filed input numeric and string and dash'),
            'alpha_dash'                            =>  __('Messages/message.this is filed input numeric and string and dash'),
            'integer'                            =>  __('Messages/message.this is filed input numeric'),
        ];
    }
}
