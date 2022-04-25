<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'product_detail_id' => 'nullable|exists:App\ProductDetail,id',
            'category_id' => 'nullable|exists:App\Category,id',
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
        ];
    }
}
