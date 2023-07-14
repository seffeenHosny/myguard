<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends AbstractFormRequest
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
            'image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'type'=>'required|in:admin,guard,company,super_admin',
            'email'=>'required|email|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone'=>'required|unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'=>'required|confirmed|min:6',
        ];

        if(request('_method' )== 'PUT'){
            $rules['email'] = 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.request('id');
            $rules['phone'] = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone,'.request('id');
            $rules['password'] = 'sometimes|nullable|confirmed|min:6';
        }
        return $rules;
    }
}
