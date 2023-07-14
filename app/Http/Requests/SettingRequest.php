<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'domain'=>'required|string',
            'tax'=>'required|numeric|min:0',
            'facebook'=>'required|url',
            'twitter'=>'required|url',
            'snapchat'=>'required|url',
            'instagram'=>'required|url',
            'aboutUs_ar'=>'required|string',
            'aboutUs_en'=>'required|string',
            'terms_ar'=>'sometimes|nullable|string',
            'terms_en'=>'sometimes|nullable|string',
            'policy_ar'=>'sometimes|nullable|string',
            'policy_en'=>'sometimes|nullable|string',
            'images'=>'sometimes|nullable|array',
            'images.*'=>'image||mimes:jpg,jpeg,png,gif,svg',
            'videos'=>'sometimes|nullable|array',
            'videos.*'=>'mimes:mp4,mov,ogg,qt|max:20000',
        ];
    }
}
