<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
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
            'nationality_id' => 'required|exists:nationalities,id',
            'branch_ids' => 'required|array',
            'branch_ids.*' => [
                'required',
                Rule::exists('branches', 'id')
                    ->where('tenant_id', tenant()->id)
            ],
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $teacher = $this->route()->parameter('teacher');

            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($teacher->id, 'id')
            ];

            unset($rules['password']); // Password is not required for update

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
