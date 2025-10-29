<?php

namespace App\Http\Requests\Tenant\Admin;

use App\Enums\EvaluationTypeEnum;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvaluationRequest extends FormRequest
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
        $evaluationIds = tenant()->evaluations->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('evaluation_translations', 'name')
                    ->whereIn('evaluation_id', $evaluationIds)
            ],
            'type' => 'required|in:' . implode(',', EvaluationTypeEnum::getConstants()),
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $evaluation = $this->route()->parameter('evaluation');

            $rules['%name%'] = [
                'required',
                Rule::unique('evaluation_translations', 'name')
                    ->whereIn('evaluation_id', $evaluationIds)
                    ->ignore($evaluation->id, 'evaluation_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        $evaluation = $this->route()->parameter('evaluation');

        return $this->merge([
            'type' => $evaluation ? $evaluation->type : $this->type,
        ]);

    }// end of prepareForValidation

}//end of request
