<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'password' => ['required', 'min:8', 'max:30'],
            'email' => ['required', 'email', 'unique:users'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام کاربر را وارد کنید',
            'password.required' => 'لطفا رمزعبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد',
            'password.max' => 'رمز عبور باید حداکثر 30 کاراکتر باشد',
            'email.required' => 'لطفا ایمیل را وارد کنید',
            'email.unique' => 'ایمیل از قبل وجود دارد',
            'email.email' => 'ایمیل نامعتبر است',
        ];
    }
}
