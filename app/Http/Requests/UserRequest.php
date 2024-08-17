<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' =>  'required','email',Rule::unique('users')->ignore($this->id),
            'role' => 'required',
            'nationalId' => 'required|numeric|min_digits:10|max_digits:20',
            'personalPhoneNumber' => 'required|numeric|min_digits:10|max_digits:20',
            'personalWhatsappNumber' => 'required|numeric|min_digits:10|max_digits:20',
            'maximumDiscount' => 'required|numeric',
            'incentive' => 'required|numeric',
            'discount' => 'required|numeric',
            'gender' => 'required|in:ذكر,انثى',
            'birthDate' => 'required|date',
            'salary' => 'required|numeric',

        ];
    }
    public function messages()
    {

        return [
            'name.required' =>  trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.same' => trans('validation.same'),
            'role.required' => trans('validation.required'),
            'avatar.required' => trans('validation.required'),
            'avatar.mimes' => trans('validation.mimes'),
            'nationalId.required' => trans('validation.required'),
            'nationalId.numeric' => trans('validation.numeric'),
            'nationalId.max_digits' => trans('validation.max_digits'),
            'nationalId.min_digits' => trans('validation.min_digits'),
            'personalPhoneNumber.required' => trans('validation.required'),
            'personalPhoneNumber.numeric' => trans('validation.numeric'),
            'personalPhoneNumber.min_digits' => trans('validation.min_digits'),
            'personalPhoneNumber.max_digits' => trans('validation.max_digits'),
            'personalWhatsappNumber.required' => trans('validation.required'),
            'personalWhatsappNumber.numeric' => trans('validation.numeric'),
            'personalWhatsappNumber.min_digits' => trans('validation.min_digits'),
            'personalWhatsappNumber.max_digits' => trans('validation.max_digits'),
            'maximumDiscount.required' => trans('validation.required'),
            'maximumDiscount.numeric' => trans('validation.numeric'),
            'incentive.required' => trans('validation.required'),
            'incentive.numeric' => trans('validation.numeric'),
            'discount.required' => trans('validation.required'),
            'discount.numeric' => trans('validation.numeric'),
            'gender.required' => trans('validation.required'),
            'gender.in' => trans('validation.in'),
            'birthDate.required' => trans('validation.required'),
            'birthDate.date' => trans('validation.date'),
            'salary.required' => trans('validation.required'),
            'salary.numeric' => trans('validation.numeric'),
        ];
    }
}
