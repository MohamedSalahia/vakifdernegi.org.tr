<?php

namespace App\Http\Requests\Tenant\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
        $bookIds = tenant()->books->pluck('id')->toArray();

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('book_translations', 'name')
                    ->whereIn('book_id', $bookIds)
            ],
            'pages_count' => 'required|integer|min:1',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $book = $this->route()->parameter('book');

            $rules['%name%'] = [
                'required',
                Rule::unique('book_translations', 'name')
                    ->whereIn('book_id', $bookIds)
                    ->ignore($book->id, 'book_id')
            ];

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

}//end of request
