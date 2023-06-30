<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'title'       => ['required', 'string'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'file', 'max:5128'],
            'video_src'   => ['string'],
            'price'       => ['required', 'integer'],
            'weight'      => ['required', 'integer'],
            'length'      => ['required', 'numeric'],
            'height'      => ['required', 'numeric'],
            'depth'       => ['required', 'numeric'],
            'icon'        => ['string', 'nullable'],
            'status'      => ['nullable', 'boolean'],
        ];
    }
}
