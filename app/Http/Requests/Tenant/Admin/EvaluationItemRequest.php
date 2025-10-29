<?php

namespace App\Http\Requests\Tenant\Admin;

use App\Enums\EvaluationTypeEnum;
use App\Models\Evaluation;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvaluationItemRequest extends FormRequest
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
        $evaluation = $this->evaluation_id
            ? Evaluation::query()
                ->with('evaluationItems')
                ->findOrFail($this->evaluation_id)
            : null;

        $evaluationItemIds = $evaluation->evaluationItems->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('evaluation_item_translations', 'name')
                    ->whereIn('evaluation_item_id', $evaluationItemIds)
            ],
            'evaluation_id' => [
                'required',
                Rule::exists('evaluations', 'id')
                    ->where('tenant_id', tenant()->id)
            ],
            'bg_color' => 'required|string|max:7',
        ];

        if ($evaluation->type == EvaluationTypeEnum::EXAM) {

            $rules['value'] = 'required|numeric|min:0';
            $rules['number_of_usage'] = 'required|numeric|min:0';
            $rules['details'] = 'sometimes|nullable|string|max:1000';

        }

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $evaluationItem = $this->route()->parameter('evaluation_item');

            $rules['%name%'] = [
                'required',
                Rule::unique('evaluation_item_translations', 'name')
                    ->whereIn('evaluation_item_id', $evaluationItemIds)
                    ->ignore($evaluationItem->id, 'evaluation_item_id')
            ];


        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        $isUpdateRequest = in_array($this->method(), ['PUT', 'PATCH']);

        $evaluationItem = $this->route('evaluation_item');

        return $this->merge([
            'evaluation_id' => $isUpdateRequest ? $evaluationItem->evaluation_id : $this->evaluation_id,
        ]);
        
    }// end of prepareForValidation

}//end of request
