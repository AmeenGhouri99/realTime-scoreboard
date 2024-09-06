<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            // 'phone_country_code' => 'required|exists:users,phone_country_code',
            'phone' => 'required|exists:users,phone',
            'password' => 'required'
        ];
    }
    public function prepareRequest()
    {
        $request = $this;
        return [
            'phone_country_code' => $request['phone_country_code'],
            'phone' => $request['phone'],
            'password' => $request['password']
        ];
    }
}
