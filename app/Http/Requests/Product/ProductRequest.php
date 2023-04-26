<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|',
            'code' => 'required|max:255',
            'price' => 'required|integer',
            'price_sale' => 'required|integer',
            'description' => 'required',
            'content' => 'required',
            'cat_id' => 'required',
            'thumb'=>'required'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'description.required' => 'Vui lòng nhập mô tả cho sản phẩm',
            'content.required' => 'Vui lòng nhập nội dung cho sản phẩm',
            'price.required' => 'Vui lòng nhập giá tiền cho sản phẩm',
            'price.interger' => 'Giá tiền phải là số tự nhiên',
            'price_sale.required' => 'Vui lòng nhập giá khuyến mãi cho sản phẩm',
            'price_sale.integer' => 'Giá khuyến mãi phải là số tự nhiên',
            'code.required' => 'Vui lòng nhập mã code cho sản phẩm',
            'code.max' => 'Mã code không được quá 255 ký tự',
            'cat_id.required' => 'Vui lòng chọn Danh mục cho sản phẩm',
            'thumb.required'=>'Vui lòng chọn ảnh'
        ];
    }
}
