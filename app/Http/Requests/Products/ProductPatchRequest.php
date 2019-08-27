<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductPatchRequest extends FormRequest
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
	        'slug' => [
		        'required',
		        'unique:products,slug,'.$this->id
	        ],
        ];
    }

    public function messages ()
    {
	    return [
	    	'slug.unique' => 'Этот slug уже у другого продукта'
	    ];
    }
}
