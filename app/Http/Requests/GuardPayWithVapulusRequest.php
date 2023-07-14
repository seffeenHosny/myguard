<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardPayWithVapulusRequest extends FormRequest
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
            "package_id" => 'required|exists:guard_packages,id',
            'user_id'=>'required|exists:users,id',
            'type'=>'required|in:guard'
        ];
    }
}
