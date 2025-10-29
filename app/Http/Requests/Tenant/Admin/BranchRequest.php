<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
        $branchIds = tenant()->branches->pluck('id')->toArray();

        $rules = [
            'country_id' => 'required|exists:countries,id',
            'governorate_id' => 'required|exists:governorates,id',
            'area_id' => 'required|exists:areas,id',
            '%name%' => [
                'required',
                Rule::unique('branch_translations', 'name')
                    ->whereIn('branch_id', $branchIds)
            ],
            'working_hour_ids' => 'required|array',
            'working_hour_ids.*' => [
                Rule::exists('working_hours', 'id')
                    ->where('tenant_id', tenant()->id)
            ],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $branch = $this->route()->parameter('branch');

            $rules['%name%'] = [
                'required',
                Rule::unique('branch_translations', 'name')
                    ->whereIn('branch_id', $branchIds)
                    ->ignore($branch->id, 'branch_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
