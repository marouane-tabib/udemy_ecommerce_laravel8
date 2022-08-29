<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorsRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST' : {
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'username' => 'required|max:20|unique:users',
                    'email' => 'required|email|max:200|unique:users',
                    'mobile' => 'required|numeric|unique:users',
                    'status' => 'required',
                    'password' => 'required|min:8',
                    'user_image' => 'nullable|mimes:jpg,jpeg,png,svg|max:2000'
                ];
            }
            case 'PUT' : {

            }
            case 'PATCH' : {
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'username' => 'required|max:20|unique:users,id,'.$this->route()->supervisor->id,
                    'email' => 'required|email|max:200|unique:users,id,'.$this->route()->supervisor->id,
                    'mobile' => 'required|numeric|unique:users,id,'.$this->route()->supervisor->id,
                    'status' => 'required',
                    'password' => 'nullable|min:8',
                    'user_image' => 'nullable|mimes:jpg,jpeg,png,svg|max:2000',
                ];
            }
            default: break;
        }
        return [
            //
        ];
    }
}
