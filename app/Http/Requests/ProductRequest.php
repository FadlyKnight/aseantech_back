<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_detail_id' => 'required|exists:App\ProductDetail,id',
            'category_id' => 'required|exists:App\Category,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ];
    }
}
