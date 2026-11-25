<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
        $notifications = [
            'title' => 'required',
            'content' => 'required',
        ];

        /*if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $role = $this->route()->parameter('role');

            $rules['title'] = 'required' . $role->id;

        }//end of if*/

        return $notifications;

    }//end of rules

}//end of request
