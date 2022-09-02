<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
            case 'POST' :
            case 'PUT' :
            case 'PATCH' : {
                return [
                    'address_title'     => 'required',
                    'fitst_name'        => 'required',
                    'last_name'         => 'required',
                    'email'             => 'required|email',
                    'mobile'            => 'required|numeric',
                    'address'           => 'required',
                    'address2'          => '',
                    'country_id'        => 'required',
                    'state_id'          => 'required',
                    'city_id'           => 'required',
                    'zip_code'          => 'required',
                    'po_box'            => 'required',
                ];
            }
            default: break;
        }
        return [
            //
        ];
    }
}
