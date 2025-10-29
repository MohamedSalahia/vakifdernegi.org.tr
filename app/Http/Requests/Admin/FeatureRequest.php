<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeatureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $plan = $this->route()->parameter('plan');

        $planFeatureIds = $plan ? $plan->features->pluck('id')->toArray() : [];

        $rules = [
            '%text%' => [
                'required',
                Rule::notIn($planFeatureIds),
            ],
            'plan_id' => 'required|exists:plans,id',
            'available' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $plan = $this->route()->parameter('plan');

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        $feature = $this->route()->parameter('feature');

        return $this->merge([
            'plan_id' => $feature ? $feature->plan_id : $this->plan_id,
            'available' => $this->available ?? 0,
        ]);

    }// end of prepareForValidation

}//end of request
