<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
            "name"=>"required",
            "slug"=>"required",
            "description"=>"required",
            "price"=>"required"
        ];
    }

    public function messages()
    {
        return [
            "name.required"=>"name is required",
            "slug.required"=>"slug is required",
            "description.required"=>"description is required",
            "price.required"=>"Price is required"
        ];
    }
}
