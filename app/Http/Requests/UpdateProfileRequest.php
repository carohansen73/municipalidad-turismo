<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'job' => 'nullable|string|max:191',
            'bio' => 'nullable|string|max:191',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg',
            'password' => 'nullable|string|min:8|max:20|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'job.max' => 'El campo trabajo / puesto no debe contener más de 191 caracteres.',
            'bio.max'  => 'El campo bio / estado no debe contener más de 191 caracteres.',
            'image.mimes' => 'El campo imagen destacada debe ser un archivo de tipo: jpg, jpeg, png, bmp, svg.',
            'password.min' => 'El campo contraseña debe contener al menos 8 caracteres.',
            'password.max' => 'El campo contraseña no debe contener más de 20 caracteres.',
            'password.confirmed' => 'El campo confirmación de contraseña no coincide.'
        ];
    }
}
