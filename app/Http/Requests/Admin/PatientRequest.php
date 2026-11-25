<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the patient is authorized to make this request.
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

        $patients = [
            'name' => 'required',
            'mobile' => 'required',
            'national_no' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'status' => 'nullable',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $patient = $this->route()->parameter('patient');


        }//end of if

        return $patients;

    }//end of rules

    /*protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'patient'
        ]);

    }*///end of prepare for validation

}//end of request
