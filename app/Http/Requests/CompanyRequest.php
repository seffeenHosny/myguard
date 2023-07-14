<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends AbstractFormRequest
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
            'name'=>'required|string|min:3',
            'commercial_registration_no'=>'required',
            'image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'type'=>'required|in:company',
            'email'=>'required|email|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone'=>'required|unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'company_type_id'=>'required|exists:company_types,id',
            'commercial_registration_image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'password'=>'required|confirmed|min:6',
            'city_id'=>'required|exists:cities,id'
        ];

        if(request('_method' )== 'PUT'){
            $rules['email'] = 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.request('id');
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone,'.request('id');
            $rules['password'] = 'sometimes|nullable|confirmed|min:6';
            $rules['commercial_registration_image']='sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif';
            $rules['type']='sometimes|nullable|in:company';
        }
        return $rules;
    }
}
