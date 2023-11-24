<?php

namespace App\Http\Requests;

use App\Services\HomeSettingService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class HomeSettingRequest extends FormRequest
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
        $keyValidation = ['required', 'string'];
        $singleDataOnlyKeys = (new HomeSettingService)->getSingleDataOnlyKeys();

        if (in_array($this->key, $singleDataOnlyKeys))
                array_push($keyValidation, 'unique:home_settings');

        return [
            'key' => $keyValidation,
            'title' => ['required', 'string'],
            'description' => ['string'],
            'content' => ['string'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,pdf', 'max:10240'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response ([
            "errors" => $validator->getMessageBag()
        ], 400));
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        //
    }
}
