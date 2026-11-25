<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the doctor is authorized to make this request.
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

        $doctors = [
            'name' => 'required',
            'password' => 'required|confirmed',
            'mobile' => 'required',
            'national_no' => 'required',
            'percentage' => 'required',
            //'branche_id' => 'required',
            'gender' => 'required',
            'department_id' => 'required',
            'job_id' => 'required',
            'status' => 'nullable',
            //'permissions' => 'required|min:1'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $doctor = $this->route()->parameter('doctor');

            $doctors['password'] = '';

        }//end of if

        return $doctors;

    }//end of rules

    /*protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'doctor'
        ]);

    }*///end of prepare for validation

}//end of request
