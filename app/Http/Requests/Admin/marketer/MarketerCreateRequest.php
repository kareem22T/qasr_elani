<?php

namespace App\Http\Requests\Admin\marketer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MarketerCreateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge(['referral_code' => rand(100000, 999999)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'string', 'min:2', 'max:191'],
            'phone'         => ['required' ,'numeric', Rule::unique('marketers', 'phone')],
            'referral_code' => ['required' ,'numeric', Rule::unique('marketers', 'referral_code')],
            'password'      => ['required', 'min:6'],
            'address'       => ['required', 'string', 'min:2', 'max:191'],
        ];
    }
}
