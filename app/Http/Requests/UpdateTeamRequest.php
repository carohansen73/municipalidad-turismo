<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Team;

class UpdateTeamRequest extends FormRequest
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
            'name' => 'required|string|max:80',
            'job' => 'required|string|max:30',
            'important_image' => 'mimes:jpg,jpeg,png,bmp,svg',
            'publish' => 'boolean'
        ];
    }

    /**
     * Get the messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return Team::$messages_es;
    }
}
