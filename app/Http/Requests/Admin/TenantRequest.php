<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantRequest extends FormRequest
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
        $rules = [
            'country_id' => 'required|exists:countries,id',
            'governorate_id' => 'required|exists:governorates,id',
            'area_id' => 'required|exists:areas,id',
            'plan_id' => 'required|exists:plans,id',
            'currency_id' => 'required|exists:currencies,id',
            'name' => 'required',
            'subdomain' => 'required|unique:domains,domain|regex:/^[a-zA-Z0-9\-]+$/',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'mobile' => 'required|unique:tenants,mobile',
            'address' => 'required',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $tenant = $this->route()->parameter('tenant');

            $rules['subdomain'] = [
                'required',
                'regex:/^[a-zA-Z0-9\-]+$/',
                Rule::unique('domains', 'domain')->ignore($tenant->id, 'tenant_id')
            ];

            $rules['email'] = '';

            $rules['mobile'] = [
                'required',
                Rule::unique('tenants', 'mobile')->ignore($tenant->id)
            ];

            $rules['password'] = '';

        }//end of if

        return $rules;

    }//end of rules

}//end of request
