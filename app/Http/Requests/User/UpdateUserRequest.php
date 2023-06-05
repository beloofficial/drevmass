<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Information\StoreInformationRequest;
use App\Models\Information;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['string'],
            'email' => ['email', 'string', 'unique:users,id,' . auth()->user()->id],
            'password' => ['min:8', 'confirmed'],
            'information.gender' => ['boolean'],
            'information.height' => ['integer'],
            'information.weight' => ['numeric'],
            'information.birth'  => ['date'],
            'information.activity' => [Rule::in(Information::LOW_ACTIVITY, Information::MIDDLE_ACTIVITY, Information::HIGH_ACTIVITY)],
        ];
    }
}
