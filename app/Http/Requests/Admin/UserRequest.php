<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $users = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');

            $users['email'] = 'required|email|unique:users,id,' . $user->id;
            $users['password'] = '';

        }//end of if

        return $users;

    }//end of rules

    /*protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'user'
        ]);

    }*///end of prepare for validation

}//end of request
