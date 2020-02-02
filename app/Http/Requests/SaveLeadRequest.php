<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLeadRequest extends FormRequest
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
        return [
            "car_category" => "required",
            "car_mark" => "required",
            "car_model" => "required",
            "lead_name" => "required|string|max:255",
            "lead_phone" => "required|unique:leads",
            "lead_mail" => "required|email",
        ];
    }

//    public function messages()
//    {
//            return [
//
//            ];
//    }
}
