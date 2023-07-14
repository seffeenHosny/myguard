<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateProfile extends AbstractFormRequest
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
        return [
            'name'=>'required|string|min:3',
            'commercial_registration_no'=>'required',
            'image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'email'=>'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.auth()->user()->id,
            'company_type_id'=>'required|exists:company_types,id',
            'commercial_registration_image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'type'=>'required|in:company',
            'city_id'=>'required|exists:cities,id'
        ];
    }
}
