<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCvRequest extends AbstractFormRequest
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
            'jop_type_id'=>'required|exists:jop_types,id',
            'name'=>'required|string',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.auth()->user()->id,
            'age'=>'required|integer|min:18|max:60',
            'gender'=>'required|in:male,female',
            'image'=>'required|image|mimes:png,jpg,svg,jpeg,gif',
            'city_id'=>'required|exists:cities,id',
            'district_id'=>'required|exists:districts,id',
            'identification_id'=>'required|image|mimes:png,jpg,svg,jpeg,gif',
            'iban_no'=>'required|integer',
            'experience'=>'required|in:from_1_year_to_5_years,from_6_year_to_10_years',
            'qualification'=>'required|in:primary,middle,secondary,other',
            'other_cities'=>'required|in:yes,no',
            'english'=>'required|in:poor,good,very_good,excellent',
            'experience_type'=>'required|in:no_experience,military_experience,experience_of_the_filed_of_security',
            'social_status'=>'required|in:single,married',
        ];
    }
}
