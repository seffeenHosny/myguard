<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobOfferRequest extends AbstractFormRequest
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
            'city_id'=>'required|exists:cities,id',
            'district_id'=>'required|exists:districts,id',
            'salary'=>'required|numeric|min:0',
            'no_of_days'=>'required|integer|min:1',
            'no_of_hours'=>'required|integer|min:1',
            'last_date_to_accept'=>'required|date',
            'users'=>'required|array',
            'users.*'=>'required|exists:users,id',
            'holiday'=>'required|in:one_day,two_day',
            'work_nature_id'=>'required|exists:work_natures,id',
            'work_nature_text'=>'required_if:work_nature_id,==,1',
        ];
    }
}
