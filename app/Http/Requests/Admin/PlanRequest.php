<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            '%name%' => ['required', Rule::unique('plan_translations', 'name')],
            'price' => 'required|numeric|min:0',
            'branches_count' => 'required|integer|min:0',
            'admins_count' => 'required|integer|min:0',
            'teachers_count' => 'required|integer|min:0',
            'students_count' => 'required|integer|min:0',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $plan = $this->route()->parameter('plan');

            $rules['%name%'] = [
                'required',
                Rule::unique('plan_translations', 'name')
                    ->ignore($plan->id, 'plan_id')
            ];


        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
