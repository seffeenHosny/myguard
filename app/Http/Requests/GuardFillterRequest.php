<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardFillterRequest extends AbstractFormRequest
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
            'jop_type_id'=>'sometimes|nullable|exists:jop_types,id',
            'age_to'=>'sometimes|nullable|integer|min:18|max:60',
            'age_from'=>'sometimes|nullable|integer|min:18|max:60',
            'number_of_guards'=>'required|integer|min:1',
            'gender'=>'sometimes|nullable|in:male,female',
            'city_id'=>'sometimes|nullable|exists:cities,id',
            'experience'=>'sometimes|nullable|in:from_1_year_to_5_years,from_6_year_to_10_years',
            'qualification'=>'sometimes|nullable|in:primary,middle,secondary,other',
            'english'=>'sometimes|nullable|in:poor,good,very_good,excellent',
        ];
    }
}
