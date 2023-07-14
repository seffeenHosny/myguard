<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPayWithVapulusRequest extends FormRequest
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
            "sessionId" => "required|string|min:20",
            "package_id" => 'required|exists:company_packages,id',
            'user_id'=>'required|exists:users,id',
            'package_type'=>'required|in:single,monthly',
            'no_of_cvs'=>'required_if:package_type,==,single|integer',
            'type'=>'required|in:company'
        ];
    }
}
