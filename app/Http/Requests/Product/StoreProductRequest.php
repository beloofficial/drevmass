<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'image'       => ['required', 'file'],
            'video_src'   => ['string'],
            'price'       => ['required', 'integer'],
            'weight'      => ['required', 'integer'],
            'length'      => ['required', 'integer'],
            'height'      => ['required', 'integer'],
            'icon'        => ['string'],
            'status'      => ['required', 'boolean'],
        ];
    }
}
