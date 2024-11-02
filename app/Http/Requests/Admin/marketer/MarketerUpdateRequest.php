<?php

namespace App\Http\Requests\Admin\marketer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MarketerUpdateRequest extends FormRequest
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
            'name'         => ['required', 'string', 'min:2', 'max:191'],
            'phone'        => ['required' ,'numeric', Rule::unique('marketers', 'phone')->ignore($this->marketer)],
            'password'     => ['nullable', 'min:6'],
            'address'      => ['required', 'string', 'min:2', 'max:191'],
        ];
    }
}
