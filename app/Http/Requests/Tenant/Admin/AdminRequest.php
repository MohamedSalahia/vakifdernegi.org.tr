<?php

namespace App\Http\Requests\Tenant\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => [
                'required', 'email',
                Rule::unique('users')->where('tenant_id', tenant()->id)
            ],
            'password' => 'required|confirmed',
            'type' => 'required',
            'role_id' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $admin = $this->route()->parameter('admin');

            $rules['email'] = [
                'required', 'email',
                Rule::unique('users')->where('tenant_id', tenant()->id)->ignore($admin->id)
            ];

            unset($rules['password']);

        }//end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'tenant_admin'
        ]);

    }//end of prepare for validation

}//end of request
