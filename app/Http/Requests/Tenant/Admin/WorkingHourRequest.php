<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkingHourRequest extends FormRequest
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
        $workingHourIds = tenant()->workingHours->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('working_hour_translations', 'name')
                    ->whereIn('working_hour_id', $workingHourIds)
            ],
            'start_time' => [
                'required', 'date_format:H:i',
            ],
            'end_time' => [
                'required', 'date_format:H:i', 'after:start_time',
            ],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $workingHour = $this->route()->parameter('working_hour');

            $rules['%name%'] = [
                'required',
                Rule::unique('working_hour_translations', 'name')
                    ->whereIn('working_hour_id', $workingHourIds)
                    ->ignore($workingHour->id, 'working_hour_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
