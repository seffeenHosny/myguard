<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardPackageRequest extends AbstractFormRequest
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
            'title_ar'=>'required|string',
            'title_en'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
            'no_of_days'=>'required|numeric|integer|min:0',
            'price'=>'required|numeric|min:0',
        ];
    }
}
