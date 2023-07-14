<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends AbstractFormRequest
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
            'contact_reason_id'=>'required|exists:contact_reasons,id',
            'message'=>'required|string',
            'file'=>'sometimes|nullable|mimes:mp4,mov,ogg,qt,jpg,jpeg,png,svg,gif|max:20000',
            'type'=>'sometimes|nullable|required_with:file|in:image,video',
        ];
    }
}
