<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateGuardProfileRequest extends AbstractFormRequest
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
            'name'=>'required|string',
            'age'=>'required|integer|min:18|max:60',
            'image'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'city_id'=>'required|exists:cities,id',
            'district_id'=>'required|exists:districts,id',
            'experience_type'=>'required|in:no_experience,military_experience,experience_of_the_filed_of_security',
            'social_status'=>'required|in:single,married',
            'identification_id'=>'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif',
            'iban_no'=>'required|integer',
            'email'=>'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.auth()->user()->id,
            'experience'=>'required|in:from_1_year_to_5_years,from_6_year_to_10_years',
            'qualification'=>'required|in:primary,middle,secondary,other',
            'other_cities'=>'required|in:yes,no',
            'english'=>'required|in:poor,good,very_good,excellent',
        ];
    }
}
