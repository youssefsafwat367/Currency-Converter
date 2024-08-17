<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAmountRequest extends FormRequest
{
    public $currencies;

    public function __construct()
    {
        parent::__construct();
        $this->currencies = implode(',', array_keys(config('currency_rates')));


    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currency' => ['required', 'string', "in:$this->currencies"],
            'amount' => ['required', 'numeric'],
        ];
    }
}
