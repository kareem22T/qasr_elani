<?php

namespace App\Http\Requests\Api;

use App\Helpers\ResponseError;
use App\Models\OrderDetail;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class FilterParamsRequest extends FormRequest
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
            "sort"        => ['string', Rule::in(['asc', 'desc'])],
            "column"      => ['string'],
            'status'      => ['string'],
            'per_page'    => ['numeric'],
            'shop_id'     => ['numeric'],
            'user_id'     => ['numeric'],
            'category_id' => ['numeric'],
            'brand_id'    => ['numeric'],
            'price'       => ['numeric'],
            'note'        => ['string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'required' => trans('validation.required', [], request()->lang),
            'min' => trans('validation.min.numeric', [], request()->lang),
            'string' => trans('validation.string', [], request()->lang),
            'numeric' => trans('validation.numeric', [], request()->lang),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = $this->requestErrorResponse(
            ResponseError::ERROR_400,
            trans('errors.' . ResponseError::ERROR_400, [], request()->lang),
            $errors->messages(), Response::HTTP_BAD_REQUEST);

        throw new HttpResponseException($response);
    }
}
