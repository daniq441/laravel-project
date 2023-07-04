<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'usernames' => 'required|unique:users',
            'userFirstName' => 'required',
            'userLastName' => 'required',
            'userPhone' => 'required|regex:/^(\+923)\d{2}-\d{7}$/',
            'userEmail' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users',
            'userPassword' => 'required|min:6',
            'gender' => 'required|in:male,female',
        ];
    }
}
