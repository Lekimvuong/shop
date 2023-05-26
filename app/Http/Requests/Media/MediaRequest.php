<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
    public function rules(): array
    {
        return [
            'files'=>'required',
            'product_id'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'files.required'=>'Vui lòng thêm ảnh',
            'product_id.required'=>'Chọn sản phẩm'
        ];
    }
}
