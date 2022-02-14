<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsersRequest extends FormRequest
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

    public function rules(Request $request)
    {
        $uri = $request->path();
        $urlArr = explode("/",$uri);
        $id=end($urlArr);
        $commonRule = [
            'name' => 'required | regex:/^[a-zA-Z_ ]*$/ | max:255',
            'email'  => 'required |email | unique:Users',
            'password' => 'required',
            'confirm_password' => 'required | same:password',
            'mobile_no' => 'required|min:10|numeric',
            'gender' => 'required | regex:/^[a-zA-Z_ ]*$/ ',
            'dob' => 'required | date_format:Y-m-d',
            'address' => 'required',
            'country_id' => 'required | numeric',
            'state_id' => 'required | numeric',
            'city_id' => 'required | numeric',
            'role_id' => 'required | numeric',
        ];

        return $commonRule;
    }
}
