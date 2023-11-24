<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactUsInquiryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'business_name' => ['required'],
            'contact_name' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required'],
            'company_name' => ['required'],
            'country' => ['required'],
            'city' => ['required'],
            'sub_distric' => ['required'],
            'additional_detail' => ['required'],

            //Supplier's Type
            'company_name' => ['required_if:type,supplier'],
            'brand_name' => ['required_if:type,supplier'],

            //Customer's Type
            'category' => ['required_if:type,customer'],
            'product' => ['required_if:type,customer'],
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response ([
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
