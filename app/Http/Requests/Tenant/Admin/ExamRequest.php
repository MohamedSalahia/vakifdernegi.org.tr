<?php

namespace App\Http\Requests\Tenant\Admin;

use App\Enums\EvaluationTypeEnum;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
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
        $examIds = tenant()->exams->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('exam_translations', 'name')
                    ->whereIn('exam_id', $examIds)
            ],
            'project_id' => [
                'required',
                Rule::exists('projects', 'id')
                    ->where('tenant_id', tenant()->id),
            ],
            'level_id' => [
                'required',
                Rule::exists('levels', 'id')
                    ->where('tenant_id', tenant()->id),
            ],
            'evaluation_id' => [
                'required',
                Rule::exists('evaluations', 'id')
                    ->where('tenant_id', tenant()->id)
                    ->where('type', EvaluationTypeEnum::EXAM),
            ],
            'highest_score' => 'required|numeric|min:1',
            'minimum_passing_score' => 'required|numeric|min:0|lte:highest_score',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $exam = $this->route()->parameter('exam');

            $rules['%name%'] = [
                'required',
                Rule::unique('exam_translations', 'name')
                    ->whereIn('exam_id', $examIds)
                    ->ignore($exam->id, 'exam_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        $exam = $this->route()->parameter('exam');

        return $this->merge([
            'project_id' => $exam ? $exam->project_id : $this->project_id,
            'level_id' => $exam ? $exam->level_id : $this->level_id,
        ]);

    }// end of prepareForValidation

}//end of request
