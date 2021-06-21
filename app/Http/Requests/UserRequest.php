<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() == 'PUT') {
            $email_rules    = 'required|email|unique:users,email,'.$this->instance()->user->id;
            $pass_rules    = 'nullable|confirmed|min:6';
        } else {
            $email_rules    = 'required|email|unique:users';
            $pass_rules    = 'required|confirmed|min:6';
        }
        return [
            'name'       => 'required|string|max:191',
            'email'      => $email_rules,
            'password'   => $pass_rules,
            'role' => 'required|string|max:20'
        ];
    }
}
