<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            '%name%' => ['required', Rule::unique('currency_translations', 'name')],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $currency = $this->route()->parameter('currency');

            $rules['%name%'] = [
                'required',
                Rule::unique('currency_translations', 'name')
                    ->ignore($currency->id, 'currency_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
