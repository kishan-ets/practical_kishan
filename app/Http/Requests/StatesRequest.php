<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StatesRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $uri = $request->path();
        $urlArr = explode("/",$uri);
        $id=end($urlArr);
        if ($this->method() == 'POST') {
            return [
                'name' => 'required|max:255|unique:states,name,NULL,id,deleted_at,NULL',
                'country_id' => 'required|integer|exists:countries,id,deleted_at,NULL'
            ];
        }
        else{
            return [
                'name' => 'required|max:255|unique:states,name,' . $id.',id,deleted_at,NULL',
                'country_id' => 'required|integer|exists:countries,id,deleted_at,NULL'
            ];
        }
    }
}
