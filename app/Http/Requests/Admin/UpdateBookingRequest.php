<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            "patient_id" => 'required|exists:patients,id',
            "branche_id" => 'required|exists:branches,id',
            "examination_room_id" => 'required|exists:examination_rooms,id',
            "examination_room_work_time_id" => 'required|exists:examination_room_work_times,id',
            "doctor_id" => 'required|exists:doctors,id',
            "date" => 'required',

        ];
    }
}
