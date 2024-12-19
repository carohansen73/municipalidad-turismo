<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'max:191',
                Rule::unique('users', 'email')->ignore($this->segment(3)),
            ],
            'name' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'password' => 'required|string|min:8|max:20|confirmed',
            'rol' => 'required|numeric'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return User::$messages_es;
    }
}
