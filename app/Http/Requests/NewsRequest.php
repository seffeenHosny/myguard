<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends AbstractFormRequest
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
            'description_ar'=>'required|string|max:280',
            'description_en'=>'required|string|max:280',
            'main_image'=>'sometimes|nullable|image',
            'images'=>'array',
            'images.*'=>'image|mimes:png,jpg,svg,jpeg,gif',
        ];
    }
}
