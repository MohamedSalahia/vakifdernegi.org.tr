<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LectureRequest extends FormRequest
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
        $lectureIds = tenant()->lectures->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('lecture_translations', 'name')
                    ->whereIn('lecture_id', $lectureIds)
            ],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $lecture = $this->route()->parameter('lecture');

            $rules['%name%'] = [
                'required',
                Rule::unique('lecture_translations', 'name')
                    ->whereIn('lecture_id', $lectureIds)
                    ->ignore($lecture->id, 'lecture_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
