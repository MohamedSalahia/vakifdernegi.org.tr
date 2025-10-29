<?php

namespace App\Http\Requests\Tenant\Admin;

use App\Models\Book;
use App\Models\Project;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LevelRequest extends FormRequest
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
        $project = $this->project_id
            ? Project::find($this->project_id)
            : null;

        $levelIds = tenant()->levels()
            ->where('project_id', $this->project_id)
            ->pluck('id')->toArray();

        $book = $this->book_id
            ? Book::find($this->book_id)
            : null;

        $rules = [
            '%name%' => [
                'required',
                Rule::unique('level_translations', 'name')
                    ->whereIn('level_id', $levelIds)
            ],
            'project_id' => [
                'required',
                Rule::exists('projects', 'id')
                    ->where('tenant_id', tenant()->id),
            ],
            'book_id' => [
                'required',
                Rule::exists('project_book', 'book_id')
                    ->where('project_id', $project->id)
            ],
            'from_page' => 'required|integer|min:1|gte:' . $project->availableFromPageForBook($book),
            'to_page' => 'required|integer|min:1|gte:from_page',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $level = $this->route()->parameter('level');

            $rules['%name%'] = [
                'required',
                Rule::unique('level_translations', 'name')
                    ->whereIn('level_id', $levelIds)
                    ->ignore($level->id, 'level_id')
            ];

            $rules['from_page'] = 'required|integer|min:1|gte:' . $project->availableFromPageForBook($book, $level->id);

        }//end of if

        return RuleFactory::make($rules);

    }//end of rules

    public function prepareForValidation()
    {
        $level = $this->route('level');

        return $this->merge([
            'project_id' => $level ? $level->project_id : $this->project_id,
        ]);

    }// end of prepareForValidation

}//end of request
