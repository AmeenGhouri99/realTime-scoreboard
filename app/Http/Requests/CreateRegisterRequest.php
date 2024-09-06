<?php

namespace App\Http\Requests;

// use App\Abstracts\FormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateRegisterRequest extends FormRequest
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
            'first_name' => 'required',
            "last_name" => 'required',
            "email" => 'required|unique:users,email',
            "phone_country_code" => 'required',
            "phone" => "required|unique:users,phone",
            'password' => 'required|confirmed|min:6',
            'profile_image' => 'nullable',
        ];
    }
    public function prepareRequest()
    {
        $request = $this;
        return [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'phone_country_code' => $request['phone_country_code'],
            'profile_image' => $request['profile_image'],
            'password' => $request['password']
        ];
    }
}
