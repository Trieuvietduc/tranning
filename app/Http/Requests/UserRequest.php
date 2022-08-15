<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        if ($request->id) {
            return [
                'name' => 'required',
                'email' => 'required|email',
            ];
        }
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            're_password' => 'same:password'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'họ và tên không được để trống',
            'email.required' => 'email không được để trống',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'password không được để trống',
            're_password.same' => '2 mật khẩu phải giống nhau'
        ];
    }
}
