<?php

namespace App\Http\Requests\Information;

use App\Models\Information;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInformationRequest extends FormRequest
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
            'gender'   => ['required', 'boolean'],
            'height'   => ['required' ,'integer'],
            'weight'   => ['required', 'numeric'],
            'birth'    => ['required', 'date'],
            'activity' => ['required', Rule::in(Information::LOW_ACTIVITY, Information::MIDDLE_ACTIVITY, Information::HIGH_ACTIVITY)],
        ];
    }
}
