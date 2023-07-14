<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JopConditionRequest extends AbstractFormRequest
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
            'condition_ar'=>'required|string',
            'condition_en'=>'required|string',
            'jop_type_id'=>'required|exists:jop_types,id',
        ];
    }
}
