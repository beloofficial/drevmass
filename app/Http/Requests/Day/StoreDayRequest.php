<?php

namespace App\Http\Requests\Day;

use Illuminate\Foundation\Http\FormRequest;

class StoreDayRequest extends FormRequest
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
            'monday'    => ['required', 'boolean'],
            'tuesday'   => ['required' ,'boolean'],
            'wednesday' => ['required', 'boolean'],
            'thursday'  => ['required', 'boolean'],
            'friday'    => ['required', 'boolean'],
            'saturday'  => ['required', 'boolean'],
            'sunday'    => ['required', 'boolean'],
            'time'      => ['required', 'date_format:H:i'],
        ];
    }
}
