<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
        $projectIds = tenant()->projects->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('project_translations', 'name')
                    ->whereIn('project_id', $projectIds)
            ],
            'evaluation_id' => [
                'required',
                Rule::exists('evaluations', 'id')
                    ->where('tenant_id', tenant()->id),
            ],
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => [
                'required',
                Rule::exists('books', 'id')
                    ->where('tenant_id', tenant()->id),
            ],
            'fees' => ['required', 'numeric', 'min:0',],
            'can_move_to_next_project' => ['required', 'boolean',],
            'has_revision' => ['required', 'boolean',],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $project = $this->route()->parameter('project');

            $rules['%name%'] = [
                'required',
                Rule::unique('project_translations', 'name')
                    ->whereIn('project_id', $projectIds)
                    ->ignore($project->id, 'project_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        return $this->merge([
            'can_move_to_next_project' => $this->can_move_to_next_project ?? 0,
            'has_revision' => $this->has_revision ?? 0,
        ]);

    }// end of prepareForValidation

}//end of request
