<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePayFomRequest extends AbstractFormRequest
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
        if(request('type') == 'guard'){
            return [
                'package_id'=>'required|exists:guard_packages,id'
            ];
        }elseif(request('type') == 'company'){
            return [
                'package_id'=>'required|exists:company_packages,id',
                'package_type'=>'required|in:single,monthly',
                'no_of_cvs'=>'required_if:package_type,==,single|integer',
            ];
        }
    }
}
