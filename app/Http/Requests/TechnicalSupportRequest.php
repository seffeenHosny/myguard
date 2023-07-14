<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalSupportRequest extends AbstractFormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'phone'=>'required|unique:technical_supports,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];

        if(request('_method' )== 'PUT'){
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:technical_supports,phone,'.request('id');
        }
        return $rules;
    }
}
