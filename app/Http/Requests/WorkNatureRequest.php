<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkNatureRequest extends AbstractFormRequest
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
            'nature_ar'=>'required|string',
            'nature_en'=>'required|string',
        ];
    }
}
