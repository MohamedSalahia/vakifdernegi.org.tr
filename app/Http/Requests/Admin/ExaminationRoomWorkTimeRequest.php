<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExaminationRoomWorkTimeRequest extends FormRequest
{
    /**
     * Determine if the DoctorWorkTime is authorized to make this request.
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

        $ExaminationRoomWorkTime = [
            'duration' => 'required',
            'date' => 'required',
            //'ExaminationRoom_id' => 'required',
        ];

        // if (in_array($this->method(), ['PUT', 'PATCH'])) {

        //     $doctor = $this->route()->parameter('doctor');

        //     $doctors['password'] = '';

        // }//end of if

        return $ExaminationRoomWorkTime;

    }//end of rules

    /*protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'doctor'
        ]);

    }*///end of prepare for validation

}//end of request
